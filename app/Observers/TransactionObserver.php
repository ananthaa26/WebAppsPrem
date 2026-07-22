<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    private function sendEmailNotification(Transaction $transaction)
    {
        try {
            $email = null;
            if (filter_var($transaction->customer_contact, FILTER_VALIDATE_EMAIL)) {
                $email = $transaction->customer_contact;
            } elseif ($transaction->user && filter_var($transaction->user->email, FILTER_VALIDATE_EMAIL)) {
                $email = $transaction->user->email;
            }

            if ($email) {
                // Generate HTML from view
                $html = view('emails.transaction_status', ['transaction' => $transaction])->render();

                // Determine subject
                $subject = 'Update Pesanan Anda (' . $transaction->invoice_number . ')';
                if ($transaction->status === 'unpaid') {
                    $subject = 'Menunggu Pembayaran Pesanan ' . $transaction->invoice_number;
                } elseif ($transaction->status === 'pending') {
                    $subject = 'Pembayaran Berhasil! Pesanan ' . $transaction->invoice_number . ' Segera Diproses';
                } elseif ($transaction->status === 'processing') {
                    $subject = 'Pesanan ' . $transaction->invoice_number . ' Sedang Diproses';
                } elseif ($transaction->status === 'completed') {
                    $subject = 'Hore! Pesanan ' . $transaction->invoice_number . ' Selesai';
                }

                \Illuminate\Support\Facades\Http::get('https://emailsend.zannstore.com/send-email', [
                    'to' => $email,
                    'subject' => $subject,
                    'message' => $html
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        try {
            $telegram = new \App\Http\Controllers\TelegramController();
            $telegram->sendTransactionNotification($transaction);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim notifikasi Telegram: ' . $e->getMessage());
        }

        $this->sendEmailNotification($transaction);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->wasChanged('status')) {
            $this->sendEmailNotification($transaction);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
