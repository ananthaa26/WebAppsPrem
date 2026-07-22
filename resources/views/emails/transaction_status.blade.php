<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Pesanan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f5; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header { background: transparent; text-align: center; padding: 30px 20px 10px 20px; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 700; }
        .content { padding: 30px; }
        .greeting { font-size: 18px; font-weight: 600; margin-bottom: 20px; }
        .status-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-bottom: 25px; text-align: center; }
        .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        
        .status-unpaid { background: #fef3c7; color: #d97706; }
        .status-pending { background: #e0e7ff; color: #4338ca; }
        .status-processing { background: #dbeafe; color: #2563eb; }
        .status-completed { background: #d1fae5; color: #059669; }
        
        .detail-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .detail-table th, .detail-table td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: left; }
        .detail-table th { color: #64748b; font-weight: 600; width: 40%; }
        .detail-table td { font-weight: 500; }
        
        .action-btn { display: inline-block; background: #f97316; color: #ffffff !important; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; transition: background 0.2s; }
        .action-btn:hover { background: #ea580c; }
        
        .footer { background: #f8fafc; text-align: center; padding: 20px; font-size: 13px; color: #64748b; border-top: 1px solid #e2e8f0; }
        
        .account-detail { background: #1e293b; color: #f8fafc; padding: 15px; border-radius: 8px; font-family: monospace; white-space: pre-wrap; text-align: left; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://demoapps.zannstore.com/images/footer_image.webp" alt="Zannstore" style="height: 80px; width: auto; max-width: 100%;">
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $transaction->user ? $transaction->user->name : 'pelanggan baru' }}!</div>
            <p>Ini adalah informasi terbaru mengenai pesanan Anda dengan nomor Invoice <strong>{{ $transaction->invoice_number }}</strong>.</p>
            
            <div class="status-box">
                <div style="margin-bottom: 10px; color: #64748b; font-size: 14px;">Status Saat Ini:</div>
                <div class="status-badge status-{{ $transaction->status }}">
                    @if($transaction->status === 'unpaid')
                        Menunggu Pembayaran
                    @elseif($transaction->status === 'pending')
                        Menunggu Proses
                    @elseif($transaction->status === 'processing')
                        Sedang Diproses
                    @elseif($transaction->status === 'completed')
                        Berhasil & Selesai
                    @endif
                </div>
                
                @if($transaction->status === 'unpaid')
                    <p style="margin-top: 15px; font-size: 14px;">Silakan selesaikan pembayaran agar pesanan bisa kami proses secepatnya.</p>
                @elseif($transaction->status === 'pending')
                    <p style="margin-top: 15px; font-size: 14px;">Pembayaran berhasil! Tim kami akan segera memproses pesanan Anda.</p>
                @elseif($transaction->status === 'processing')
                    <p style="margin-top: 15px; font-size: 14px;">Mohon ditunggu, pesanan Anda sedang kami siapkan.</p>
                @elseif($transaction->status === 'completed')
                    <p style="margin-top: 15px; font-size: 14px;">Terima kasih! Pesanan Anda telah selesai.</p>
                @endif
            </div>

            <table class="detail-table">
                <tr>
                    <th>Produk</th>
                    <td>{{ $transaction->product ? $transaction->product->name : 'Produk' }} (x{{ $transaction->quantity }})</td>
                </tr>
                <tr>
                    <th>Varian</th>
                    <td>{{ $transaction->variant ? $transaction->variant->label : '-' }}</td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ strtoupper($transaction->payment_method) }}</td>
                </tr>
            </table>

            @if($transaction->status === 'completed' && $transaction->description_detail)
                <div style="margin-bottom: 25px;">
                    <strong style="color: #334155;">Detail Akun / Pesanan:</strong>
                    <div class="account-detail">{{ $transaction->description_detail }}</div>
                </div>
            @endif

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/pesanan?invoice=' . $transaction->invoice_number) }}" class="action-btn">Cek Detail Pesanan</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} ZANNSTORE. All rights reserved.<br>
            Harap tidak membalas email ini karena email ini dikirim oleh sistem otomatis.
        </div>
    </div>
</body>
</html>
