<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TelegramController extends Controller
{
    private $botToken;
    private $ownerChatId;
    private $webhookSecret;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token');
        $this->ownerChatId = config('services.telegram.owner_chat_id');
        $this->webhookSecret = config('services.telegram.webhook_secret');
    }

    /**
     * Helper: Melakukan request ke API Telegram
     */
    private function telegramRequest(string $method, array $data = [])
    {
        if (!$this->botToken) {
            Log::error('Telegram Bot Token tidak dikonfigurasi.');
            return null;
        }

        $url = "https://api.telegram.org/bot{$this->botToken}/{$method}";

        try {
            $response = Http::post($url, $data);
            if (!$response->successful()) {
                Log::error('Telegram API Error', [
                    'method' => $method,
                    'response' => $response->json(),
                ]);
            }
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Telegram API Exception', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Helper: Menjawab callback query (menghilangkan loading pada tombol inline)
     */
    private function answerCallback(string $callbackQueryId, string $text, bool $showAlert = false)
    {
        return $this->telegramRequest('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    /**
     * Webhook Endpoint
     */
    public function webhook(Request $request)
    {
        // Validasi secret token dari header jika dikonfigurasi
        if ($this->webhookSecret) {
            $providedSecret = $request->header('X-Telegram-Bot-Api-Secret-Token');
            if ($providedSecret !== $this->webhookSecret) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
        }

        $payload = $request->all();

        if (isset($payload['callback_query'])) {
            $this->handleCallbackQuery($payload['callback_query']);
        } elseif (isset($payload['message'])) {
            $this->handleMessage($payload['message']);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Mengirim notifikasi transaksi baru ke Telegram Owner
     */
    public function sendTransactionNotification(Transaction $transaction)
    {
        if (!$this->ownerChatId) {
            Log::error('Telegram Owner Chat ID tidak dikonfigurasi.');
            return;
        }

        $text = "🛒 *TRANSAKSI BARU*\n\n";
        $text .= "Invoice: `{$transaction->invoice_number}`\n";
        $text .= "Customer: {$transaction->customer_contact}\n";
        $text .= "Total: Rp " . number_format($transaction->total_price, 0, ',', '.') . "\n";
        $text .= "Status: *Pending*\n";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '⚙️ Process', 'callback_data' => "process_{$transaction->id}"],
                    ['text' => '❌ Cancel', 'callback_data' => "cancel_{$transaction->id}"]
                ]
            ]
        ];

        $response = $this->telegramRequest('sendMessage', [
            'chat_id' => $this->ownerChatId,
            'text' => $text,
            'parse_mode' => 'Markdown',
            'reply_markup' => json_encode($keyboard)
        ]);

        if (isset($response['result']['message_id'])) {
            $transaction->update([
                'telegram_message_id' => $response['result']['message_id']
            ]);
        }
    }

    /**
     * Menangani interaksi tombol inline
     */
    private function handleCallbackQuery($callbackQuery)
    {
        $callbackQueryId = $callbackQuery['id'];
        $chatId = $callbackQuery['message']['chat']['id'];
        $messageId = $callbackQuery['message']['message_id'];
        $data = $callbackQuery['data']; // contoh: process_123

        // Pastikan hanya owner yang bisa memproses
        if ($chatId != $this->ownerChatId) {
            $this->answerCallback($callbackQueryId, "Anda tidak memiliki akses.", true);
            return;
        }

        $parts = explode('_', $data);
        if (count($parts) !== 2) {
            $this->answerCallback($callbackQueryId, "Format aksi tidak valid.");
            return;
        }

        $action = $parts[0];
        $transactionId = $parts[1];

        // Temukan transaksi
        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            $this->answerCallback($callbackQueryId, "Transaksi tidak ditemukan.", true);
            return;
        }

        switch ($action) {
            case 'process':
                $this->handleProcessTransaction($callbackQueryId, $chatId, $messageId, $transaction);
                break;
            case 'cancel':
                $this->handleCancelTransaction($callbackQueryId, $chatId, $messageId, $transaction);
                break;
            case 'complete':
                $this->handleCompleteTransaction($callbackQueryId, $chatId, $messageId, $transaction);
                break;
            default:
                $this->answerCallback($callbackQueryId, "Aksi tidak dikenali.");
        }
    }

    private function handleProcessTransaction($callbackId, $chatId, $messageId, Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            $this->answerCallback($callbackId, "Status transaksi saat ini adalah {$transaction->status}, tidak bisa diproses ulang.", true);
            return;
        }

        // Lock & update
        $transaction = Transaction::where('id', $transaction->id)->lockForUpdate()->first();
        $transaction->update(['status' => 'processing']);

        $this->answerCallback($callbackId, "Transaksi sedang diproses.");

        // Edit pesan
        $text = "⏳ *TRANSAKSI DIPROSES*\n\n";
        $text .= "Invoice: `{$transaction->invoice_number}`\n";
        $text .= "Customer: {$transaction->customer_contact}\n";
        $text .= "Total: Rp " . number_format($transaction->total_price, 0, ',', '.') . "\n";
        $text .= "Status: *Processing*\n";

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '✅ Complete', 'callback_data' => "complete_{$transaction->id}"],
                    ['text' => '❌ Cancel', 'callback_data' => "cancel_{$transaction->id}"]
                ]
            ]
        ];

        $this->telegramRequest('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'parse_mode' => 'Markdown',
            'reply_markup' => json_encode($keyboard)
        ]);
    }

    private function handleCancelTransaction($callbackId, $chatId, $messageId, Transaction $transaction)
    {
        if (!in_array($transaction->status, ['pending', 'processing'])) {
            $this->answerCallback($callbackId, "Transaksi dengan status {$transaction->status} tidak dapat dibatalkan.", true);
            return;
        }

        $transaction = Transaction::where('id', $transaction->id)->lockForUpdate()->first();

        // Kembalikan saldo jika menggunakan metode saldo
        if ($transaction->payment_method === 'saldo' && $transaction->user_id) {
            $user = \App\Models\User::find($transaction->user_id);
            if ($user) {
                $user->increment('balance', $transaction->total_price);
            }
        }

        // Kembalikan stok varian jika ada
        if ($transaction->variant_id) {
            $variant = \App\Models\ProductVariant::find($transaction->variant_id);
            if ($variant) {
                $variant->increment('stock', $transaction->quantity);
            }
        }

        $transaction->update(['status' => 'failed']); // sesuai ENUM database (failed)

        $this->answerCallback($callbackId, "Transaksi dibatalkan.");

        // Menghapus tombol dan mengedit teks
        $text = "❌ *TRANSAKSI DIBATALKAN*\n\n";
        $text .= "Invoice: `{$transaction->invoice_number}`\n";
        $text .= "Status: *Failed/Cancelled*\n";

        $this->telegramRequest('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);
    }

    private function handleCompleteTransaction($callbackId, $chatId, $messageId, Transaction $transaction)
    {
        if ($transaction->status !== 'processing') {
            $this->answerCallback($callbackId, "Hanya transaksi berstatus processing yang bisa diselesaikan.", true);
            return;
        }

        // Set cache state bahwa admin sedang mengisi description_detail untuk transaksi ini
        Cache::put("telegram_pending_description:{$chatId}", $transaction->id, now()->addMinutes(15));

        $this->answerCallback($callbackId, "Silakan kirim detail penyelesaian.");

        $text = "📝 Masukkan detail penyelesaian untuk transaksi `{$transaction->invoice_number}`.\n\n";
        $text .= "Contoh:\nAkun: example@gmail.com\nPassword: example123\nCatatan: Pesanan sukses diproses\n\n";
        $text .= "Balas pesan ini dengan rincian transaksi.";

        $this->telegramRequest('sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);
    }

    /**
     * Menangani pesan teks (berguna untuk description_detail saat menyelesaikan transaksi)
     */
    private function handleMessage($message)
    {
        if (!isset($message['text'])) return;
        
        $chatId = $message['chat']['id'];
        $text = $message['text'];

        if ($chatId != $this->ownerChatId) return;

        // Cek apakah owner sedang dalam state melengkapi transaksi
        $pendingTransactionId = Cache::get("telegram_pending_description:{$chatId}");
        
        if ($pendingTransactionId) {
            $transaction = Transaction::find($pendingTransactionId);
            
            if ($transaction && $transaction->status === 'processing') {
                $transaction = Transaction::where('id', $transaction->id)->lockForUpdate()->first();
                $transaction->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                    'description_detail' => $text
                ]);

                if ($transaction->product) {
                    $transaction->product->increment('total_sold', $transaction->quantity);
                }

                Cache::forget("telegram_pending_description:{$chatId}");

                // Kirim notifikasi berhasil diselesaikan
                $successText = "✅ *TRANSAKSI SELESAI*\n\n";
                $successText .= "Invoice: `{$transaction->invoice_number}`\n";
                $successText .= "Status: *Completed*\n\n";
                $successText .= "Detail:\n{$text}\n\n";
                $successText .= "Pesanan telah berhasil diselesaikan.";

                $this->telegramRequest('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => $successText,
                    'parse_mode' => 'Markdown'
                ]);

                // Edit pesan transaksi utama untuk menghilangkan tombol inline
                if ($transaction->telegram_message_id) {
                    $mainText = "✅ *TRANSAKSI SELESAI*\n\n";
                    $mainText .= "Invoice: `{$transaction->invoice_number}`\n";
                    $mainText .= "Customer: {$transaction->customer_contact}\n";
                    $mainText .= "Total: Rp " . number_format($transaction->total_price, 0, ',', '.') . "\n";
                    $mainText .= "Status: *Completed*\n";

                    $this->telegramRequest('editMessageText', [
                        'chat_id' => $chatId,
                        'message_id' => $transaction->telegram_message_id,
                        'text' => $mainText,
                        'parse_mode' => 'Markdown'
                    ]);
                }
            } else {
                Cache::forget("telegram_pending_description:{$chatId}");
                $this->telegramRequest('sendMessage', [
                    'chat_id' => $chatId,
                    'text' => 'Transaksi tidak ditemukan atau status sudah tidak processing.'
                ]);
            }
        }
    }
}
