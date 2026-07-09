<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk / Daftar — ZANNSTORE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (!t) {
                t = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            }
            if (t === 'light') document.documentElement.classList.add('light');
            document.designMode = 'off';
        })();
    </script>
    <style>
        body, body * {
            -webkit-user-modify: read-only !important;
        }
        input, textarea, select, [contenteditable="true"] {
            -webkit-user-modify: read-write !important;
        }
        .auth-container {
            max-width: 400px;
            margin: 40px auto;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }
        .auth-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }
        .auth-header p {
            font-size: 14px;
            color: var(--text-muted);
        }
        .auth-tabs {
            display: flex;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 24px;
        }
        .light .auth-tabs {
            background: rgba(0, 0, 0, 0.05);
        }
        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.3s ease;
            user-select: none;
        }
        .auth-tab.active {
            background: var(--bg-card) !important;
            color: var(--text-main) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
        }
        .light .auth-tab.active {
            background: #fff !important;
        }
        .auth-form {
            display: none;
        }
        .auth-form.active {
            display: block !important;
        }
        .input-group {
            margin-bottom: 16px;
        }
        .input-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }
        .input-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }
        .light .input-control {
            background: #f8f9fa;
        }
        .input-control:focus {
            border-color: #ff416c;
            box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }
        .light .input-control:focus {
            background: #fff;
        }
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
        }
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: var(--text-muted);
            font-size: 12px;
        }
        .auth-divider::before, .auth-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        .auth-divider span {
            padding: 0 10px;
        }
        .btn-google {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            border: 1px solid var(--border-color);
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .light .btn-google {
            background: #fff;
        }
        .btn-google:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #ff4b2b;
        }
        .light .btn-google:hover {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    @include('components.alert')
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 70vh; display: flex; align-items: center;">
                <div class="auth-container w-100">
                    <div class="auth-header">
                        <h1>Selamat Datang</h1>
                        <p>Masuk atau daftar untuk melanjutkan</p>
                    </div>

                    <div class="auth-tabs">
                        <div id="tab-login" class="auth-tab active">Masuk</div>
                        <div id="tab-register" class="auth-tab">Daftar</div>
                    </div>

                    <form action="/login" method="POST" class="auth-form active" id="form-login">
                        @csrf
                        @if($errors->any())
                        <div style="background: rgba(255,65,108,0.15); border: 1px solid rgba(255,65,108,0.3); border-radius: 10px; padding: 12px; margin-bottom: 16px; color: #ff416c; font-size: 13px; font-weight: 600;">
                            {{ $errors->first() }}
                        </div>
                        @endif
                        <div class="input-group">
                            <label>Alamat Email</label>
                            <input type="email" name="email" class="input-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="input-group">
                            <label>Kata Sandi</label>
                            <input type="password" name="password" class="input-control" placeholder="••••••••" required>
                        </div>
                        <div style="text-align: right; margin-bottom: 16px;">
                            <a href="#" style="color: #ff4b2b; font-size: 12px; text-decoration: none; font-weight: 600;">Lupa Sandi?</a>
                        </div>
                        <button type="submit" class="btn-submit">Masuk Sekarang</button>
                    </form>

                    <form action="/register" method="POST" class="auth-form" id="form-register">
                        @csrf
                        <div class="input-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="input-control" placeholder="Nama Anda" required>
                        </div>
                        <div class="input-group">
                            <label>Alamat Email</label>
                            <input type="email" name="email" class="input-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="input-group">
                            <label>Kata Sandi</label>
                            <input type="password" name="password" class="input-control" placeholder="Buat kata sandi" required>
                        </div>
                        <button type="submit" class="btn-submit">Daftar Akun</button>
                    </form>

                    <script>
                        (function() {
                            var tl = document.getElementById('tab-login');
                            var tr = document.getElementById('tab-register');
                            var fl = document.getElementById('form-login');
                            var fr = document.getElementById('form-register');

                            tl.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                tl.className = 'auth-tab active';
                                tr.className = 'auth-tab';
                                fl.className = 'auth-form active';
                                fr.className = 'auth-form';
                                return false;
                            }, true);

                            tr.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                tr.className = 'auth-tab active';
                                tl.className = 'auth-tab';
                                fr.className = 'auth-form active';
                                fl.className = 'auth-form';
                                return false;
                            }, true);
                        })();
                    </script>

                    <div class="auth-divider">
                        <span>ATAU</span>
                    </div>

                    <a href="/auth/google/redirect" class="btn-google">
                        <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Lanjutkan dengan Google
                    </a>
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
        applyTheme(localStorage.getItem('zann-theme') || 'dark');
    </script>
</body>
</html>
