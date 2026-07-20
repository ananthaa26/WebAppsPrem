<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Pesanan — ZANNSTORE</title>
    <meta name="description" content="Cek status pesanan dan detail akun premium Anda di ZANNSTORE.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Anti-FOUC: terapkan tema sebelum render -->
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (t === 'light') document.documentElement.classList.add('light');
        })();
    </script>
</head>

<body>
    <!-- ALERT COMPONENT -->
    @include('components.alert')

    <!-- TOP BAR -->
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 50vh;">
                <div class="sec-head" style="display: flex; align-items: center; gap: 12px; justify-content: flex-start;">
                    <a href="/" class="btn-back" aria-label="Kembali ke Beranda">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div class="sec-t" style="margin-bottom: 0;">Cek Pesanan</div>
                </div>
                
                <p style="color: var(--t2); font-size: 14px; margin-bottom: 24px; line-height: 1.6;">
                    Lacak status pesanan Anda dengan memasukkan Nomor Invoice di bawah ini.
                </p>

                <!-- Form Search Invoice -->
                <div style="margin-bottom: 24px;">
                    <form action="" method="GET" style="display: flex; gap: 12px; flex-direction: column;">
                        <input type="text" name="invoice" placeholder="Contoh: INV-20260708-001" 
                            style="width: 100%; padding: 14px 16px; border-radius: var(--r2); border: 1px solid var(--border); background: var(--bg); color: var(--t1); font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s;"
                            value="{{ request('invoice') }}"
                            required>
                        <button type="submit" 
                            style="padding: 14px 24px; border-radius: var(--r2); background: var(--primary); color: white; border: none; font-weight: 600; cursor: pointer; font-family: inherit; transition: opacity 0.2s;">
                            Cek Sekarang
                        </button>
                    </form>
                </div>

                @if(request('invoice'))
                    @if($transaction)
                        <!-- Hasil Riwayat Transaksi -->
                        <div class="pcard" style="margin-bottom: 24px; cursor: default;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px dashed var(--border);">
                                <div>
                                    <div style="font-size: 12px; color: var(--t2); margin-bottom: 4px;">No. Invoice</div>
                                    <div style="font-weight: 700; font-size: 14px; color: var(--t1);">{{ $transaction->invoice_number }}</div>
                                </div>
                                <div id="statusBadgeWrapper">
                                @if($transaction->status === 'completed')
                                    <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        Selesai
                                    </div>
                                @elseif($transaction->status === 'processing')
                                    <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        Diproses
                                    </div>
                                @elseif($transaction->status === 'failed')
                                    <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        Gagal
                                    </div>
                                @else
                                    <div style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        Menunggu
                                    </div>
                                @endif
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 16px;">
                                <div style="width: 48px; height: 48px; background: var(--bg); border-radius: var(--r1); display: flex; align-items: center; justify-content: center; font-size: 24px; overflow: hidden;">
                                    @if($transaction->product->image)
                                        <img src="{{ asset('storage/' . $transaction->product->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        🛒
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--t1); margin-bottom: 4px;">{{ $transaction->product->name }}</div>
                                    <div style="font-size: 12px; color: var(--t2);">Varian: {{ $transaction->variant ? $transaction->variant->label : '-' }} ({{ $transaction->variant ? $transaction->variant->duration_days : 0 }} Hari)</div>
                                </div>
                            </div>

                            <div id="statusDetailWrapper">
                            @if($transaction->status === 'completed' && $transaction->description_detail)
                                <div style="background: var(--bg); padding: 16px; border-radius: var(--r1);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <div style="font-size: 12px; color: var(--t2);">Detail Akun / Pesanan:</div>
                                        <button onclick="copyAccountDetail()" style="background: var(--card); border: 1px solid var(--border); padding: 4px 10px; font-size: 12px; font-weight: 600; color: var(--t1); cursor: pointer; border-radius: 6px; display: flex; align-items: center; gap: 6px; transition: background 0.2s;">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                            </svg>
                                            <span id="copyBtnText">Salin</span>
                                        </button>
                                    </div>
                                    <div id="accountDetailText" style="font-family: monospace; font-size: 14px; color: var(--t1); line-height: 1.6; background: var(--card); padding: 12px; border-radius: 8px; border: 1px solid var(--border); white-space: pre-wrap;">{{ $transaction->description_detail }}</div>
                                </div>
                            @elseif($transaction->status === 'failed')
                                <div style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); padding: 16px; border-radius: var(--r1); text-align: center; color: #ef4444; font-size: 13px;">
                                    ❌ Transaksi dibatalkan atau gagal diproses. Silakan hubungi admin.
                                </div>
                            @else
                                <div style="background: var(--bg); padding: 16px; border-radius: var(--r1); text-align: center; color: var(--t2); font-size: 13px;">
                                    ⏳ Pesanan Anda sedang diproses oleh admin. Rincian akun akan muncul di sini jika status sudah selesai.
                                </div>
                            @endif
                            </div>
                        </div>
                    @else
                        <!-- State error jika invoice salah -->
                        <div style="text-align: center; padding: 40px 20px; background: var(--card); border-radius: var(--r2); border: 1px solid var(--border);">
                            <div style="font-size: 40px; margin-bottom: 16px;">❌</div>
                            <div style="font-weight: 600; color: var(--t1); margin-bottom: 8px;">Transaksi Tidak Ditemukan</div>
                            <div style="font-size: 13px; color: var(--t2);">Invoice <b>{{ request('invoice') }}</b> tidak ditemukan. Silahkan diperiksa kembali nomor invoice anda</div>
                        </div>
                    @endif
                @else
                    <!-- State Kosong jika belum input -->
                    <div style="text-align: center; padding: 40px 20px; background: var(--card); border-radius: var(--r2); border: 1px solid var(--border);">
                        <div style="font-size: 40px; margin-bottom: 16px; opacity: 0.5;">🔍</div>
                        <div style="font-weight: 600; color: var(--t1); margin-bottom: 8px;">Cari Pesanan Anda</div>
                        <div style="font-size: 13px; color: var(--t2);">Masukkan nomor invoice pada kolom di atas untuk melihat status dan mengambil detail akun pesanan Anda.</div>
                    </div>
                @endif
                
            </div>
            
            <!-- FOOTER -->
            @include('components.footer')

        </div>
    </main>

    <div class="spacer"></div>

    <script>
        // ===== THEME TOGGLE =====
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;

        function applyTheme(theme) {
            if (theme === 'light') {
                html.classList.add('light');
            } else {
                html.classList.remove('light');
            }
            localStorage.setItem('zann-theme', theme);
        }

        if (themeToggle) {
            themeToggle.addEventListener('click', function () {
                const isLight = html.classList.contains('light');
                applyTheme(isLight ? 'dark' : 'light');
                this.classList.add('theme-pulse');
                setTimeout(() => this.classList.remove('theme-pulse'), 400);
            });
        }
        applyTheme(localStorage.getItem('zann-theme') || 'dark');

        // (Alert system kini dipanggil melalui komponen global components/alert.blade.php)

        // ===== COPY ACCOUNT DETAIL =====
        function copyAccountDetail() {
            const textToCopy = document.getElementById('accountDetailText').innerText;
            navigator.clipboard.writeText(textToCopy).then(() => {
                // Ubah sementara teks tombol
                const btnText = document.getElementById('copyBtnText');
                const originalText = btnText.innerText;
                btnText.innerText = 'Tersalin!';
                setTimeout(() => {
                    btnText.innerText = originalText;
                }, 2000);
                
                // Tampilkan alert
                showToast('Detail akun berhasil disalin!', 'success');
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
                showToast('Gagal menyalin detail akun', 'error');
            });
        }

        @if(request('invoice') && isset($transaction) && in_array($transaction->status, ['pending', 'processing']))
        // Auto Update with Server-Sent Events (SSE)
        (function() {
            const invoice = '{{ $transaction->invoice_number }}';
            const sse = new EventSource('/api/pesanan/stream?invoice=' + invoice);
            
            sse.onmessage = function(event) {
                const data = JSON.parse(event.data);
                
                // Update Status Badge
                const badgeWrapper = document.getElementById('statusBadgeWrapper');
                if (badgeWrapper) {
                    if (data.status === 'completed') {
                        badgeWrapper.innerHTML = '<div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Selesai</div>';
                    } else if (data.status === 'processing') {
                        badgeWrapper.innerHTML = '<div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Diproses</div>';
                    } else if (data.status === 'failed') {
                        badgeWrapper.innerHTML = '<div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Gagal</div>';
                    }
                }
                
                // Update Detail
                const detailWrapper = document.getElementById('statusDetailWrapper');
                if (detailWrapper && data.status === 'completed' && data.detail) {
                    detailWrapper.innerHTML = `
                        <div style="background: var(--bg); padding: 16px; border-radius: var(--r1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <div style="font-size: 12px; color: var(--t2);">Detail Akun / Pesanan:</div>
                                <button onclick="copyAccountDetail()" style="background: var(--card); border: 1px solid var(--border); padding: 4px 10px; font-size: 12px; font-weight: 600; color: var(--t1); cursor: pointer; border-radius: 6px; display: flex; align-items: center; gap: 6px; transition: background 0.2s;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                    <span id="copyBtnText">Salin</span>
                                </button>
                            </div>
                            <div id="accountDetailText" style="font-family: monospace; font-size: 14px; color: var(--t1); line-height: 1.6; background: var(--card); padding: 12px; border-radius: 8px; border: 1px solid var(--border); white-space: pre-wrap;">${data.detail.replace(/</g, "&lt;").replace(/>/g, "&gt;")}</div>
                        </div>
                    `;
                    showToast('Pesanan selesai! Akun telah dikirim.', 'success');
                    sse.close();
                } else if (detailWrapper && data.status === 'failed') {
                    detailWrapper.innerHTML = `
                        <div style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); padding: 16px; border-radius: var(--r1); text-align: center; color: #ef4444; font-size: 13px;">
                            ❌ Transaksi dibatalkan atau gagal diproses. Silakan hubungi admin.
                        </div>
                    `;
                    showToast('Pesanan gagal.', 'error');
                    sse.close();
                }
            };

            sse.onerror = function() {
                // Ignore silent reconnects, SSE handles it natively
                // sse.close(); can be called if we want to stop
            };
        })();
        @endif
    </script>
    
    <!-- BOTTOM NAV -->
    @include('components.bottom-nav')
</body>
</html>
