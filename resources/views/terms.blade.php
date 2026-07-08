<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Syarat & Ketentuan — ZANNSTORE</title>
    <meta name="description" content="Syarat & ketentuan yang berlaku untuk pembelian layanan premium di ZANNSTORE.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Anti-FOUC: terapkan tema sebelum render -->
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (t === 'light') document.documentElement.classList.add('light');
        })();
    </script>
    <style>
        .terms-content {
            color: var(--t1);
            font-size: 14px;
            line-height: 1.7;
        }
        .terms-section {
            margin-bottom: 24px;
            background: var(--card);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: var(--r2);
            transition: border-color 0.2s;
        }
        .terms-section:hover {
            border-color: var(--t3);
        }
        .terms-h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .terms-list {
            padding-left: 20px;
            margin: 0;
        }
        .terms-list li {
            margin-bottom: 8px;
            color: var(--t2);
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 50vh;">
                <div class="sec-head"
                    style="display: flex; align-items: center; gap: 12px; justify-content: flex-start; margin-bottom: 20px;">
                    <a href="/" class="btn-back" aria-label="Kembali ke Beranda">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div class="sec-t" style="margin-bottom: 0;">Syarat & Ketentuan</div>
                </div>

                <p style="color: var(--t2); font-size: 14px; margin-bottom: 24px; line-height: 1.6;">
                    Harap membaca Syarat & Ketentuan ini dengan saksama sebelum melakukan transaksi di ZANNSTORE. Dengan menggunakan layanan kami, Anda dianggap telah menyetujui seluruh poin berikut.
                </p>

                <div class="terms-content">
                    <!-- Section 1 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">
                            <span style="font-size: 18px;"></span> 1. Ketentuan Umum
                        </h2>
                        <ul class="terms-list">
                            <li>ZANNSTORE menyediakan jasa pembelian langganan aplikasi premium legal/resmi.</li>
                            <li>Semua produk digital diproses secara otomatis maupun manual dengan estimasi 1-5 menit setelah pembayaran terverifikasi.</li>
                            <li>Pembeli wajib memberikan informasi yang valid, seperti nomor WhatsApp/Telegram yang aktif untuk pengiriman detail akun.</li>
                        </ul>
                    </div>

                    <!-- Section 2 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">
                            <span style="font-size: 18px;"></span> 2. Garansi & Klaim
                        </h2>
                        <ul class="terms-list">
                            <li>Setiap produk memiliki masa garansi yang bervariasi sesuai dengan durasi produk yang dibeli.</li>
                            <li>Garansi berupa penggantian akun (full replace) apabila terjadi masalah pada akun yang bukan disebabkan oleh kelalaian pengguna.</li>
                            <li>Klaim garansi harus menyertakan bukti pembayaran dan dilaporkan secara jelas melalui kontak layanan bantuan resmi kami.</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">
                            <span style="font-size: 18px;"></span> 3. Batasan Penggunaan
                        </h2>
                        <ul class="terms-list">
                            <li>Dilarang keras mengubah profil, email, password, maupun melakukan perubahan metode pembayaran pada akun sharing yang diberikan.</li>
                            <li>Satu akun sharing dilarang digunakan di perangkat melebihi batas layar yang telah ditentukan pada deskripsi produk.</li>
                            <li>Pelanggaran terhadap aturan penggunaan akan mengakibatkan garansi hangus tanpa adanya pengembalian dana (refund).</li>
                        </ul>
                    </div>
                </div>
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

                // Animasi pulse pada tombol
                this.classList.add('theme-pulse');
                setTimeout(() => this.classList.remove('theme-pulse'), 400);
            });
        }

        // Init tema dari localStorage
        const savedTheme = localStorage.getItem('zann-theme') || 'dark';
        applyTheme(savedTheme);
    </script>

    <!-- BOTTOM NAV -->
    @include('components.bottom-nav')
</body>

</html>
