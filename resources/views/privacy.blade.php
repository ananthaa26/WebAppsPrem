<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kebijakan Privasi — ZANNSTORE</title>
    <meta name="description" content="Kebijakan privasi ZANNSTORE mengenai cara kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda.">
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
                    <div class="sec-t" style="margin-bottom: 0;">Kebijakan Privasi</div>
                </div>

                <p style="color: var(--t2); font-size: 14px; margin-bottom: 24px; line-height: 1.6;">
                    Kebijakan Privasi ini menjelaskan bagaimana ZANNSTORE mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami. Kami berkomitmen menjaga kepercayaan dan privasi setiap pengguna.
                </p>

                <div class="terms-content">
                    <!-- Section 1 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">1. Data yang Kami Kumpulkan</h2>
                        <ul class="terms-list">
                            <li>Nomor WhatsApp atau username Telegram yang Anda masukkan saat melakukan pembelian.</li>
                            <li>Riwayat transaksi dan produk yang dibeli untuk keperluan verifikasi dan layanan garansi.</li>
                            <li>Informasi teknis dasar seperti jenis perangkat (tidak dikumpulkan secara aktif, hanya untuk keperluan teknis).</li>
                        </ul>
                    </div>

                    <!-- Section 2 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">2. Penggunaan Data</h2>
                        <ul class="terms-list">
                            <li>Data yang Anda berikan hanya digunakan untuk keperluan pengiriman detail akun premium yang dibeli.</li>
                            <li>Kami tidak menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga manapun.</li>
                            <li>Data dapat digunakan untuk memberikan notifikasi penting terkait akun atau status garansi Anda.</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">3. Keamanan Data</h2>
                        <ul class="terms-list">
                            <li>Kami menerapkan langkah-langkah keamanan standar industri untuk melindungi data pribadi Anda dari akses yang tidak sah.</li>
                            <li>Seluruh data transaksi disimpan secara aman dan tidak dapat diakses oleh pihak yang tidak berkepentingan.</li>
                            <li>Jika terjadi pelanggaran keamanan data yang berdampak pada informasi Anda, kami akan segera memberitahu Anda melalui kontak yang telah diberikan.</li>
                        </ul>
                    </div>

                    <!-- Section 4 -->
                    <div class="terms-section">
                        <h2 class="terms-h2">4. Hak Anda</h2>
                        <ul class="terms-list">
                            <li>Anda berhak meminta penghapusan data pribadi Anda dari sistem kami kapan saja.</li>
                            <li>Anda dapat menghubungi tim kami melalui halaman <a href="/hubungi-kami" style="color: var(--primary); text-decoration: underline;">Hubungi Kami</a> untuk pertanyaan terkait privasi.</li>
                            <li>Dengan menggunakan layanan kami, Anda menyetujui kebijakan privasi ini sepenuhnya.</li>
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
                this.classList.add('theme-pulse');
                setTimeout(() => this.classList.remove('theme-pulse'), 400);
            });
        }

        const savedTheme = localStorage.getItem('zann-theme') || 'dark';
        applyTheme(savedTheme);
    </script>

    <!-- BOTTOM NAV -->
    @include('components.bottom-nav')
</body>

</html>
