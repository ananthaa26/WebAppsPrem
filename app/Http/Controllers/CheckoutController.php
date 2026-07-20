<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(\Illuminate\Http\Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated.'], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_contact' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $product = \App\Models\Product::findOrFail($request->product_id);
        $variant = null;
        $price = 0;

        if ($request->filled('variant_id')) {
            $variant = \App\Models\ProductVariant::where('product_id', $product->id)->find($request->variant_id);
            if (!$variant) {
                return response()->json(['status' => 'error', 'message' => 'Varian tidak ditemukan.']);
            }
            if ($variant->stock < $request->quantity) {
                return response()->json(['status' => 'error', 'message' => 'Stok varian tidak mencukupi.']);
            }
            $price = $variant->price;
        } else {
            // Handle if there's no variant, maybe the product itself has a price?
            // Assuming variant is required for price in this app context, based on previous code.
            return response()->json(['status' => 'error', 'message' => 'Produk tidak memiliki varian harga yang valid.']);
        }

        $totalPrice = $price * $request->quantity;

        // Check Saldo
        if ($user->balance < $totalPrice) {
            return response()->json(['status' => 'error', 'message' => 'Saldo tidak mencukupi untuk pembelian ini.']);
        }

        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // Deduct balance
            $user->balance -= $totalPrice;
            $user->save();

            // Deduct stock
            if ($variant) {
                $variant->stock -= $request->quantity;
                $variant->save();
            }

            // Create Invoice
            $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));

            // Create Transaction
            $transaction = \App\Models\Transaction::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => $user->id,
                'product_id' => $product->id,
                'variant_id' => $variant ? $variant->id : null,
                'customer_contact' => $request->customer_contact,
                'quantity' => $request->quantity,
                'price_per_item' => $price,
                'total_price' => $totalPrice,
                'status' => 'pending', // Set to pending to trigger telegram process flow
                'payment_method' => 'saldo',
                'paid_at' => now(),
            ]);

            \Illuminate\Support\Facades\DB::commit();

            // Send Telegram Notification
            try {
                app(\App\Http\Controllers\TelegramController::class)->sendTransactionNotification($transaction);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed sending telegram notif on checkout: ' . $e->getMessage());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat!',
                'invoice' => $invoiceNumber
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem, silakan coba lagi.',
            ]);
        }
    }
}
