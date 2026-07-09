<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Saya — ZANNSTORE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (t === 'light') document.documentElement.classList.add('light');
        })();
    </script>
    <style>
        .profile-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            margin: -80px auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 36px;
            font-weight: 700;
            border: 4px solid var(--bg-main);
            box-shadow: 0 10px 20px rgba(255, 65, 108, 0.3);
        }
        .profile-name {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }
        .profile-email {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }
        .profile-stats {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-box {
            flex: 1;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            padding: 15px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .light .stat-box {
            background: #f8f9fa;
        }
        .stat-box:hover {
            transform: translateY(-5px);
            border-color: #ff416c;
        }
        .stat-val {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 5px;
        }
        .stat-lbl {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .menu-list {
            text-align: left;
            margin-top: 20px;
        }
        .menu-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 12px;
            color: var(--text-main);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .light .menu-item {
            background: #fff;
        }
        .menu-item:hover {
            background: rgba(255, 65, 108, 0.1);
            border-color: #ff416c;
            color: #ff416c;
            transform: translateX(5px);
        }
        .menu-icon {
            margin-right: 15px;
            display: flex;
            align-items: center;
        }
        .btn-logout {
            display: block;
            width: 100%;
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            border: 1px solid rgba(255, 65, 108, 0.3);
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            margin-top: 30px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: #ff416c;
            color: #fff;
        }
    </style>
</head>
<body>
    @include('components.alert')
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 70vh;">
                <div class="profile-card">
                    @auth
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="profile-avatar" style="object-fit: cover;">
                        @else
                            <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        @endif
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-email">{{ auth()->user()->email }}</div>
                    @else
                        <div class="profile-avatar">U</div>
                        <div class="profile-name">Pengguna Demo</div>
                        <div class="profile-email">pengguna@demo.com</div>
                    @endauth

                    <div class="profile-stats">
                        <div class="stat-box">
                            <div class="stat-val">0</div>
                            <div class="stat-lbl">Pesanan</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-val">Rp 0</div>
                            <div class="stat-lbl">Saldo</div>
                        </div>
                    </div>

                    <div class="menu-list">
                        <a href="#" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            Pengaturan Akun
                        </a>
                        <a href="/pesanan" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            Riwayat Pesanan
                        </a>
                        <a href="#" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            Bantuan & Dukungan
                        </a>
                    </div>
                    
                    @auth
                        <form action="/logout" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-logout">Keluar Akun</button>
                        </form>
                    @else
                        <a href="/auth" class="btn-logout" style="background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #fff;">Masuk Akun</a>
                    @endauth
                </div>
            </div>
        </div>
    </main>

    @include('components.bottom-nav')

</body>
</html>
