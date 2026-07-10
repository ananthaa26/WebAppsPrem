<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan Akun — ZANNSTORE</title>
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
        .setting-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            margin-top: 20px;
            margin-bottom: 80px; /* Tambahan agar tidak tertutup bottom bar */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .setting-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        .setting-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
        }
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            transition: all 0.3s ease;
        }
        .light .btn-back {
            background: rgba(0,0,0,0.05);
        }
        .btn-back:hover {
            background: var(--border-color);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }
        .light .form-control {
            background: #f8f9fa;
        }
        .form-control:focus {
            border-color: #ff416c;
            box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.15);
        }
        .btn-save {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: #fff;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
        }

        .danger-zone {
            margin-top: 40px;
            padding: 20px;
            border: 1px solid rgba(255, 65, 108, 0.3);
            border-radius: 16px;
            background: rgba(255, 65, 108, 0.05);
        }
        .danger-title {
            color: #ff416c;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
        }
        .danger-desc {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 16px;
        }
        .btn-delete {
            background: #ff416c;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background: #e63946;
        }

        /* Custom Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.show {
            display: flex;
            opacity: 1;
        }
        .modal-content {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 24px;
            border-radius: 20px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .modal-overlay.show .modal-content {
            transform: scale(1);
        }
        .modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }
        .modal-desc {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }
        .modal-actions {
            display: flex;
            gap: 12px;
        }
        .btn-cancel {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-main);
            font-weight: 600;
            cursor: pointer;
        }
        .btn-confirm {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: #ff416c;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @include('components.alert')
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 70vh;">
                <div class="setting-card">
                    <div class="setting-header">
                        <a href="/akun" class="btn-back">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                        </a>
                        <div class="setting-title">Pengaturan Akun</div>
                    </div>

                    <!-- Form Profil -->
                    <form action="/akun/setting/profile" method="POST" style="margin-bottom: 30px;">
                        @csrf
                        <div style="font-weight: 700; color: var(--text-main); margin-bottom: 16px; font-size: 16px;">Informasi Pribadi</div>
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </form>

                    <!-- Form Password -->
                    <form action="/akun/setting/password" method="POST">
                        @csrf
                        <div style="font-weight: 700; color: var(--text-main); margin-bottom: 16px; font-size: 16px; padding-top: 20px; border-top: 1px solid var(--border-color);">Ubah Kata Sandi</div>
                        <div class="form-group">
                            <label class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah sandi">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kata Sandi Baru</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Minimal 6 karakter">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Sandi Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Ulangi sandi baru">
                        </div>
                        <button type="submit" class="btn-save" style="background: rgba(255,255,255,0.05); color: var(--text-main); border: 1px solid var(--border-color);">Perbarui Sandi</button>
                    </form>

                    <!-- Hapus Akun -->
                    <div class="danger-zone">
                        <div class="danger-title">Hapus Akun Permanen</div>
                        <div class="danger-desc">Sekali Anda menghapus akun, tidak ada jalan kembali. Tolong berhati-hati. Semua data pesanan dan riwayat Anda akan dihapus secara permanen.</div>
                        <button type="button" class="btn-delete" onclick="showDeleteModal()">Hapus Akun Saya</button>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Custom Modal Confirm -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <div class="modal-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            </div>
            <div class="modal-title">Hapus Akun Permanen?</div>
            <div class="modal-desc">Semua data Anda akan hilang dan tidak dapat dipulihkan. Apakah Anda yakin?</div>
            
            <form action="/akun/setting/delete" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="hideDeleteModal()">Batal</button>
                    <button type="submit" class="btn-confirm">Ya, Hapus!</button>
                </div>
            </form>
        </div>
    </div>

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

        // Modal Logic
        function showDeleteModal() {
            var modal = document.getElementById('deleteModal');
            modal.style.display = 'flex';
            setTimeout(function() { modal.classList.add('show'); }, 10);
        }

        function hideDeleteModal() {
            var modal = document.getElementById('deleteModal');
            modal.classList.remove('show');
            setTimeout(function() { modal.style.display = 'none'; }, 300);
        }
    </script>
</body>
</html>
