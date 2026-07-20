<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deposit Saldo — ZANNSTORE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (!t) {
                t = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            }
            if (t === 'light') document.documentElement.classList.add('light');
        })();
    </script>
    <style>
        .deposit-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .deposit-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 15px;
        }
        .deposit-desc {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }
        .icon-wrapper {
            width: 80px;
            height: 80px;
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    @include('components.alert')
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 70vh;">
                <div class="deposit-card">
                    <div class="icon-wrapper">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="deposit-title">Halaman Deposit</div>
                    <div class="deposit-desc">Fitur deposit saat ini sedang dalam tahap pengembangan (Coming Soon). Silakan kembali lagi nanti untuk melakukan isi saldo ke akun Anda.</div>
                </div>
            </div>
        </div>
    </main>

    @include('components.bottom-nav')

    <script>
        var themeToggle = document.getElementById('themeToggle');
        var html = document.documentElement;

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
                var isLight = html.classList.contains('light');
                applyTheme(isLight ? 'dark' : 'light');
                this.classList.add('theme-pulse');
                var self = this;
                setTimeout(function() { self.classList.remove('theme-pulse'); }, 400);
            });
        }
    </script>
</body>
</html>
