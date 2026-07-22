<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:10000'
        ]);

        $nominal = $request->nominal;
        $trx_id = 'ZND-' . time() . '-' . rand(100, 999);
        $user = auth()->user();

        // Buat record deposit pending
        $deposit = Deposit::create([
            'invoice_number' => $trx_id,
            'user_id' => $user->id,
            'amount' => $nominal,
            'payment_method' => 'qris',
            'status' => 'pending',
        ]);

        // Hit Payment Gateway
        $merchant = env('PAYGATEWAY_MERCHANT_ID');
        $secret = env('PAYGATEWAY_SECRET_KEY');
        $signature = hash('sha256', $merchant . $secret . $trx_id);

        $payload = [
            'request' => 'new',
            'merchant' => $merchant,
            'trx_id' => $trx_id,
            'payment' => 'QRIS2',
            'amount' => $nominal,
            'customer_name' => $user->name,
            'note' => 'Deposit Saldo ' . $trx_id,
            'expired_time' => '30m',
            'panduan_pay' => false,
            'type_fee' => 'user',
            'return_url' => url('/akun'),
            'callback_url' => url('/api/payment/callback/deposit'),
            'signature' => $signature
        ];

        try {
            $response = Http::post(env('PAYGATEWAY_BASE_URL', 'https://pay.zannstore.com/v1'), $payload);
            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                $deposit->update(['checkout_url' => $result['data']['checkout_url']]);
                
                return back()
                    ->with('success', 'Permintaan deposit berhasil dibuat. Anda akan dialihkan ke halaman pembayaran...')
                    ->with('checkout_url', $result['data']['checkout_url']);
            } else {
                Log::error('Payment Gateway Error', ['response' => $result]);
                return back()->with('error', 'Gagal memproses pembayaran: ' . ($result['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            Log::error('Payment Gateway Exception', ['msg' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan sistem saat menghubungi gateway pembayaran.');
        }
    }

    public function callback(Request $request)
    {
        $data = $request->input('data');
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'No data'], 400);
        }

        $trx_id = $data['trx_id'] ?? null;
        $status = $data['status'] ?? null;

        if (!$trx_id || !$status) {
            return response()->json(['success' => false, 'message' => 'Invalid data'], 400);
        }

        $deposit = Deposit::where('invoice_number', $trx_id)->first();
        if (!$deposit) {
            return response()->json(['success' => false, 'message' => 'Deposit not found'], 404);
        }

        // Jika transaksi masih pending
        if ($deposit->status === 'pending') {
            if (strtolower($status) === 'success') {
                $deposit->status = 'completed';
                $deposit->paid_at = now();
                $deposit->save();

                // Tambahkan saldo ke user
                $user = User::find($deposit->user_id);
                if ($user) {
                    $user->increment('balance', $deposit->amount);
                }
            } elseif (in_array(strtolower($status), ['failed', 'expired', 'cancel', 'canceled'])) {
                $deposit->status = 'failed';
                $deposit->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
