<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_contact' => 'required|string|max:255',
            'payment_method' => 'required|in:saldo,qris',
        ]);

        $paymentMethod = $request->payment_method;
        $user = auth()->check() ? auth()->user() : null;

        if ($paymentMethod === 'saldo' && !$user) {
            return response()->json(['status' => 'error', 'message' => 'Anda harus login untuk menggunakan saldo.'], 401);
        }

        $product = Product::findOrFail($request->product_id);
        $variant = null;
        $price = 0;

        if ($request->filled('variant_id')) {
            $variant = ProductVariant::where('product_id', $product->id)->find($request->variant_id);
            if (!$variant) {
                return response()->json(['status' => 'error', 'message' => 'Varian tidak ditemukan.']);
            }
            if ($variant->stock < $request->quantity) {
                return response()->json(['status' => 'error', 'message' => 'Stok varian tidak mencukupi.']);
            }
            $price = $variant->price;
        } else {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak memiliki varian harga yang valid.']);
        }

        $totalPrice = $price * $request->quantity;

        if ($paymentMethod === 'saldo') {
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Silakan login terlebih dahulu untuk menggunakan Saldo Akun.']);
            }
            if ($user->balance < $totalPrice) {
                return response()->json(['status' => 'error', 'message' => 'Saldo tidak mencukupi untuk pembelian ini.']);
            }

            DB::beginTransaction();
            try {
                // Deduct balance
                $user->balance -= $totalPrice;
                $user->save();

                // Deduct stock
                $variant->stock -= $request->quantity;
                $variant->save();

                // Create Invoice
                $invoiceNumber = 'ZNP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'variant_id' => $variant->id,
                    'customer_contact' => $request->customer_contact,
                    'quantity' => $request->quantity,
                    'price_per_item' => $price,
                    'total_price' => $totalPrice,
                    'status' => 'pending', 
                    'payment_method' => 'saldo',
                    'paid_at' => now(),
                ]);

                DB::commit();

                // Send Telegram Notification
                try {
                    app(TelegramController::class)->sendTransactionNotification($transaction);
                } catch (\Exception $e) {
                    Log::error('Failed sending telegram notif on checkout: ' . $e->getMessage());
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Pesanan berhasil dibuat!',
                    'invoice' => $invoiceNumber
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Checkout Error: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan sistem, silakan coba lagi.',
                ]);
            }
        } elseif ($paymentMethod === 'qris') {
            DB::beginTransaction();
            try {
                // For QRIS, we deduct stock only when paid, but if we don't deduct it now, someone else might buy it.
                // Let's deduct stock now. If it expires, a cleanup job should restore it (outside scope for now, or just leave it).
                $variant->stock -= $request->quantity;
                $variant->save();

                $invoiceNumber = 'ZNP-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

                $transaction = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'user_id' => $user ? $user->id : null,
                    'product_id' => $product->id,
                    'variant_id' => $variant->id,
                    'customer_contact' => $request->customer_contact,
                    'quantity' => $request->quantity,
                    'price_per_item' => $price,
                    'total_price' => $totalPrice,
                    'status' => 'unpaid', // Waiting for payment
                    'payment_method' => 'qris',
                ]);

                // Hit Zannstore Pay
                $merchant = env('PAYGATEWAY_MERCHANT_ID');
                $secret = env('PAYGATEWAY_SECRET_KEY');
                $signature = hash('sha256', $merchant . $secret . $invoiceNumber);

                $payload = [
                    'request' => 'new',
                    'merchant' => $merchant,
                    'trx_id' => $invoiceNumber,
                    'payment' => 'QRIS2',
                    'amount' => $totalPrice,
                    'customer_name' => $request->customer_contact,
                    'note' => 'Pembayaran ' . $invoiceNumber,
                    'expired_time' => '30m',
                    'panduan_pay' => false,
                    'type_fee' => 'user',
                    'return_url' => url('/pesanan?invoice=' . $invoiceNumber),
                    'callback_url' => url('/api/payment/callback/transaction'),
                    'signature' => $signature
                ];

                $response = Http::post(env('PAYGATEWAY_BASE_URL', 'https://pay.zannstore.com/v1'), $payload);
                $result = $response->json();

                if ($response->successful() && isset($result['status']) && $result['status'] === true) {
                    $checkoutUrl = $result['data']['checkout_url'];
                    $transaction->update(['checkout_url' => $checkoutUrl]);
                    DB::commit();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Pesanan berhasil dibuat, mengalihkan ke pembayaran...',
                        'invoice' => $invoiceNumber,
                        'checkout_url' => $checkoutUrl
                    ]);
                } else {
                    DB::rollBack();
                    Log::error('Payment Gateway Error (Transaction)', ['response' => $result]);
                    return response()->json(['status' => 'error', 'message' => 'Gagal menghubungkan ke payment gateway.']);
                }

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Checkout QRIS Error: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan sistem, silakan coba lagi.',
                ]);
            }
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

        $transaction = Transaction::where('invoice_number', $trx_id)->first();
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        if ($transaction->status === 'unpaid') {
            if (strtolower($status) === 'success') {
                $transaction->status = 'pending'; // 'pending' means paid and waiting for process
                $transaction->paid_at = now();
                $transaction->save();
                
                // Send Telegram Notification
                try {
                    app(TelegramController::class)->sendTransactionNotification($transaction);
                } catch (\Exception $e) {
                    Log::error('Failed sending telegram notif on callback: ' . $e->getMessage());
                }
            } elseif (in_array(strtolower($status), ['failed', 'expired', 'cancel', 'canceled'])) {
                $transaction->status = 'failed';
                $transaction->save();
            }
        }

        return response()->json(['success' => true]);
    }

    public function rateTransaction(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $transaction = Transaction::where('invoice_number', $request->invoice_number)->first();
        if (!$transaction) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan tidak ditemukan.'], 404);
        }

        if ($transaction->status !== 'completed') {
            return response()->json(['status' => 'error', 'message' => 'Hanya pesanan yang sudah selesai yang dapat diberikan rating.'], 400);
        }

        if ($transaction->rating !== null) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan ini sudah diberikan rating.'], 400);
        }

        $transaction->update(['rating' => $request->rating]);

        return response()->json([
            'status' => 'success',
            'message' => 'Terima kasih! Penilaian Anda telah disimpan.'
        ]);
    }
}
