<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami — ZANNSTORE</title>
    <meta name="description" content="Hubungi tim ZANNSTORE untuk bantuan terkait langganan premium Anda.">
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
</head>

<body>

    <!-- TOP BAR -->
    @include('components.topbar')

    <main>
        <div class="w">
            <div class="sec" style="min-height: 50vh;">
                <div class="sec-head"
                    style="display: flex; align-items: center; gap: 12px; justify-content: flex-start;">
                    <a href="/" class="btn-back" aria-label="Kembali ke Beranda">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div class="sec-t" style="margin-bottom: 0;">Hubungi Kami</div>
                </div>

                <p style="color: var(--t2); font-size: 14px; margin-bottom: 24px; line-height: 1.6;">
                    Punya pertanyaan, butuh bantuan, atau ada kendala dengan langganan Anda? Jangan ragu untuk
                    menghubungi kami melalui kontak di bawah ini. Tim kami selalu siap membantu Anda dengan cepat dan
                    ramah.
                </p>

                <div class="pgrid" style="grid-template-columns: 1fr; gap: 16px;">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/6285174279764" target="_blank" class="pcard"
                        style="display: flex; flex-direction: row; align-items: center; gap: 16px;">
                        <div class="p-ico" style="background:#25D366;border-color:#1EBE5D;margin:0;">
                            <svg viewBox="0 0 24 24" fill="white" style="width: 24px; height: 24px;">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </div>
                        <div>
                            <div class="p-name">WhatsApp</div>
                            <div class="p-dur" style="margin-bottom:0">Respon Cepat (08:00 - 22:00)</div>
                        </div>
                    </a>

                    <!-- Email -->
                    <a href="mailto:helpdesk@zannstore.com" class="pcard"
                        style="display: flex; flex-direction: row; align-items: center; gap: 16px;">
                        <div class="p-ico" style="background:#ea4335;border-color:#d93025;margin:0;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                style="width: 20px; height: 20px; color: white;">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div class="p-name">Email Support</div>
                            <div class="p-dur" style="margin-bottom:0">helpdesk@zannstore.com</div>
                        </div>
                    </a>
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