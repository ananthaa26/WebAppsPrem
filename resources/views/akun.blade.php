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
            if (!t) {
                t = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            }
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

        /* VERIFY MODAL */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
      .modal-content {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            transform: translateY(20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .modal-overlay.active .modal-content {
            transform: translateY(0) scale(1);
        }
        .modal-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
        }
        .modal-text {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 25px;
            line-height: 1.5;
        }
        .modal-actions {
            display: flex;
            gap: 15px;
        }
        .btn-modal {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancel {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }
        .light .btn-cancel {
            background: #f1f3f5;
            border-color: #dee2e6;
        }
        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .light .btn-cancel:hover {
            background: #e9ecef;
        }
        .btn-confirm {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #fff;
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
        }
        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 65, 108, 0.4);
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
                        <div class="profile-email" style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                            {{ auth()->user()->email }}
                            @if(auth()->user()->email_verified_at)
                                <svg title="Email Terverifikasi" fill="#34A853" viewBox="0 0 24 24" width="16" height="16"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            @else
                                <a href="#" style="display: flex; align-items: center; color: #ff416c; text-decoration: none;" onclick="openVerifyModal(event)" title="Belum Aktif, Klik untuk aktivasi">
                                    <svg fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="profile-avatar">U</div>
                        <div class="profile-name">Pengguna Demo</div>
                        <div class="profile-email">pengguna@demo.com</div>
                    @endauth

                    <div class="profile-stats">
                        <div class="stat-box">
                            <div class="stat-val">{{ auth()->check() ? \App\Models\Transaction::where('user_id', auth()->id())->count() : 0 }}</div>
                            <div class="stat-lbl">Pesanan</div>
                        </div>
                        <div class="stat-box">
                            <div class="stat-val">Rp {{ auth()->check() ? number_format(auth()->user()->balance ?? 0, 0, ',', '.') : '0' }}</div>
                            <div class="stat-lbl">Saldo</div>
                        </div>
                    </div>

                    <div class="menu-list">
                        <a href="/akun/setting" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            Pengaturan Akun
                        </a>
                        <a href="/akun/deposit" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            Deposit Saldo
                        </a>
                        <a href="/hubungi-kami" class="menu-item">
                            <div class="menu-icon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            Bantuan & Dukungan
                        </a>
                    </div>
                    
                    @auth
                        <form action="/logout" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-logout">Keluar</button>
                        </form>
                    @else
                        <a href="/auth" class="btn-logout" style="background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #fff;">Masuk Akun</a>
                    @endauth
                </div>

                @auth
                <div class="profile-card" style="margin-top: 20px; text-align: left; padding: 20px;">
                    <h3 style="font-size: 18px; margin-bottom: 20px; color: var(--text-main);">Riwayat Pesanan Terbaru</h3>
                    @if($transactions->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($transactions as $trx)
                            <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); padding: 16px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="font-weight: 600; font-size: 14px; color: var(--text-main);">{{ $trx->invoice_number }}</div>
                                    @if($trx->status === 'completed')
                                        <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Selesai</div>
                                    @elseif($trx->status === 'processing')
                                        <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Diproses</div>
                                    @elseif($trx->status === 'failed')
                                        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Gagal</div>
                                    @else
                                        <div style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Menunggu</div>
                                    @endif
                                </div>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div style="width: 40px; height: 40px; background: var(--bg-main); border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                                        @if($trx->product && $trx->product->image)
                                            <img src="{{ asset('storage/' . $trx->product->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            🛒
                                        @endif
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: var(--text-main); font-size: 13px;">{{ $trx->product ? $trx->product->name : 'Produk Dihapus' }}</div>
                                        <div style="font-size: 12px; color: var(--text-muted);">{{ $trx->created_at->format('d M Y, H:i') }} • Rp {{ number_format($trx->total_price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div style="margin-top: 8px; padding-top: 8px; border-top: 1px dashed var(--border-color); text-align: right;">
                                    <a href="/pesanan?invoice={{ $trx->invoice_number }}" style="color: #ff416c; font-size: 12px; font-weight: 600; text-decoration: none;">Cek Detail ➔</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        @if($transactions->hasPages())
                            <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; gap: 5px;">
                                @if ($transactions->onFirstPage())
                                    <div style="padding: 6px 12px; border-radius: 8px; background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-muted); opacity: 0.5; font-size: 12px; font-weight: 600; user-select: none; white-space: nowrap;">&laquo; Prev</div>
                                @else
                                    <a href="{{ $transactions->previousPageUrl() }}" style="padding: 6px 12px; border-radius: 8px; background: rgba(255, 65, 108, 0.1); color: #ff416c; border: 1px solid rgba(255, 65, 108, 0.2); text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.2s; white-space: nowrap;">&laquo; Prev</a>
                                @endif

                                <div style="font-size: 11px; color: var(--text-muted); font-weight: 600; white-space: nowrap; text-align: center;">
                                    Hal {{ $transactions->currentPage() }} / {{ $transactions->lastPage() }}
                                </div>

                                @if ($transactions->hasMorePages())
                                    <a href="{{ $transactions->nextPageUrl() }}" style="padding: 6px 12px; border-radius: 8px; background: rgba(255, 65, 108, 0.1); color: #ff416c; border: 1px solid rgba(255, 65, 108, 0.2); text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.2s; white-space: nowrap;">Next &raquo;</a>
                                @else
                                    <div style="padding: 6px 12px; border-radius: 8px; background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-muted); opacity: 0.5; font-size: 12px; font-weight: 600; user-select: none; white-space: nowrap;">Next &raquo;</div>
                                @endif
                            </div>
                        @endif
                    @else
                        <div style="text-align: center; padding: 30px; color: var(--text-muted); font-size: 14px;">Belum ada transaksi.</div>
                    @endif
                </div>
                @endauth
            </div>
        </div>
    </main>

    <div class="spacer"></div>

    <!-- VERIFY MODAL -->
    <div class="modal-overlay" id="verifyModal">
        <div class="modal-content">
            <div class="modal-icon">
                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="modal-title">Verifikasi Email</h3>
            <p class="modal-text">Kirim link aktivasi ke email Anda sekarang?</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" onclick="closeVerifyModal()">Batal</button>
                <a href="/auth/verify-email/send" class="btn-modal btn-confirm">Ya, Kirim</a>
            </div>
        </div>
    </div>

    @include('components.bottom-nav')

    <script>
        var themeToggle = document.getElementById('themeToggle');
        var html = document.documentElement;

        function openVerifyModal(e) {
            if (e) e.preventDefault();
            document.getElementById('verifyModal').classList.add('active');
        }

        function closeVerifyModal() {
            document.getElementById('verifyModal').classList.remove('active');
        }

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
