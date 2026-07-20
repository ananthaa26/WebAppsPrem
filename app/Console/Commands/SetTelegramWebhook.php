<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetTelegramWebhook extends Command
{
    protected $signature = 'telegram:set-webhook {--url= : URL webhook opsional (jika kosong akan menggunakan url aplikasi)}';

    protected $description = 'Set webhook URL untuk Telegram Bot';

    public function handle()
    {
        $botToken = config('services.telegram.bot_token');
        if (!$botToken) {
            $this->error('TELEGRAM_BOT_TOKEN belum diatur di file .env');
            return;
        }

        $url = $this->option('url');
        if (!$url) {
            $url = url('/api/telegram/webhook');
        }

        $this->info("Menyetel webhook ke: {$url}");

        $response = \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/setWebhook", [
            'url' => $url,
            'secret_token' => config('services.telegram.webhook_secret'),
        ]);

        if ($response->successful()) {
            $this->info('Berhasil menyetel webhook Telegram!');
        } else {
            $this->error('Gagal menyetel webhook.');
            $this->error($response->body());
        }
    }
}
