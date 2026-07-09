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
                    <!-- Hasil Riwayat Transaksi (Statik / UI Only) -->
                    <div class="pcard" style="margin-bottom: 24px; cursor: default;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px dashed var(--border);">
                            <div>
                                <div style="font-size: 12px; color: var(--t2); margin-bottom: 4px;">No. Invoice</div>
                                <div style="font-weight: 700; font-size: 14px; color: var(--t1);">{{ strtoupper(request('invoice')) }}</div>
                            </div>
                            <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                Sukses
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 16px;">
                            <div style="width: 48px; height: 48px; background: var(--bg); border-radius: var(--r1); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                🎬
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--t1); margin-bottom: 4px;">Netflix Premium</div>
                                <div style="font-size: 12px; color: var(--t2);">Varian: 1 Bulan (Sharing)</div>
                            </div>
                        </div>

                        <div style="background: var(--bg); padding: 16px; border-radius: var(--r1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <div style="font-size: 12px; color: var(--t2);">Detail Akun:</div>
                                <button onclick="copyAccountDetail()" style="background: var(--card); border: 1px solid var(--border); padding: 4px 10px; font-size: 12px; font-weight: 600; color: var(--t1); cursor: pointer; border-radius: 6px; display: flex; align-items: center; gap: 6px; transition: background 0.2s;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                    <span id="copyBtnText">Salin</span>
                                </button>
                            </div>
                            <div id="accountDetailText" style="font-family: monospace; font-size: 14px; color: var(--t1); line-height: 1.6; background: var(--card); padding: 12px; border-radius: 8px; border: 1px solid var(--border); white-space: pre-wrap;">Email : netflix_pro@zannstore.com
Pass  : zannstore123
Profil: User 1</div>
                        </div>
                    </div>
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
    </script>
    
    <!-- BOTTOM NAV -->
    @include('components.bottom-nav')
</body>
</html>
