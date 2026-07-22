<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Update Pesanan Anda (' . $this->transaction->invoice_number . ')';
        if ($this->transaction->status === 'unpaid') {
            $subject = 'Menunggu Pembayaran Pesanan ' . $this->transaction->invoice_number;
        } elseif ($this->transaction->status === 'pending') {
            $subject = 'Pembayaran Berhasil! Pesanan ' . $this->transaction->invoice_number . ' Segera Diproses';
        } elseif ($this->transaction->status === 'processing') {
            $subject = 'Pesanan ' . $this->transaction->invoice_number . ' Sedang Diproses';
        } elseif ($this->transaction->status === 'completed') {
            $subject = 'Hore! Pesanan ' . $this->transaction->invoice_number . ' Selesai';
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transaction_status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
