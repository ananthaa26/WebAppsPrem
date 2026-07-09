<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZANNSTORE — Langganan Premium Murah</title>
    <meta name="description"
        content="Beli langganan premium murah, aman, proses otomatis. Spotify, Netflix, Canva, CapCut dan lainnya.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Anti-FOUC: terapkan tema sebelum render -->
    <script>
        (function () {
            var t = localStorage.getItem('zann-theme');
            if (!t) {
                t = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            }
            if (t === 'light') document.documentElement.classList.add('light');
        })();
    </script>
</head>

<body>

    <!-- TOP BAR -->
    @include('components.topbar')

    <main>
        <div class="w">

            <!-- SEARCH -->
            <div class="search-wrap">
                <div class="search-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari produk..." id="search-input">
                </div>
            </div>

            <!-- HERO BANNER -->
            <div class="hero-banner">
                <img src="/images/banner.webp" alt="Banner Promo" class="hero-banner-img">
            </div>

            <!-- CATEGORIES -->
            <div class="cats">
                <button class="cat on">Semua</button>
                <button class="cat">Desain</button>
                <button class="cat">AI Tools</button>
                <button class="cat">Streaming</button>
                <button class="cat">Musik</button>
                <button class="cat">Tools</button>
            </div>

            <!-- BEST SELLER -->
            <div class="sec">
                <div class="sec-head">
                    <div class="sec-t">
                        <img src="https://cdn.zannstore.com/assets/project/zannstore.com/GIF/fire.webp"
                            alt="Best Seller" class="sec-icon">
                        Best Seller
                    </div>
                    <a href="#" class="sec-more">Lihat Semua →</a>
                </div>
                <div class="pgrid">
                    <!-- CapCut -->
                    <div class="pcard" data-title="CapCut Pro" data-price="44900"
                        data-desc="Fitur lengkap tanpa watermark. Cocok buat edit reels & TikTok." data-dur="1 Bulan">
                        <div class="rk rk-1">1</div>
                        <span class="p-tag p-tag-hot">HOT</span>
                        <div class="p-ico" style="background:#000;border-color:#333">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#000" />
                                <path d="M14 24l10-6v5l10-5v12l-10-5v5L14 24z" fill="white" />
                            </svg>
                        </div>
                        <div class="p-name">CapCut Pro</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 44.900</div>
                            <div class="p-sold">77K terjual</div>
                        </div>
                    </div>
                    <!-- Canva -->
                    <div class="pcard" data-title="Canva Pro" data-price="25000"
                        data-desc="Akses semua template premium Canva. Cocok buat desain konten, presentasi, poster."
                        data-dur="1 Bulan">
                        <div class="rk rk-2">2</div>
                        <div class="p-ico" style="background:#7d2ae8;border-color:#9b59b6">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#7d2ae8" /><text x="24" y="32"
                                    text-anchor="middle" font-size="22" font-weight="800" fill="white"
                                    font-family="Arial">C</text>
                            </svg>
                        </div>
                        <div class="p-name">Canva Pro</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 5.000</div>
                            <div class="p-sold">15K terjual</div>
                        </div>
                    </div>
                    <!-- Spotify -->
                    <div class="pcard" data-title="Spotify Premium" data-price="8900"
                        data-desc="Dengerin musik tanpa iklan, bisa download lagu, kualitas audio HiFi."
                        data-dur="1 Bulan">
                        <div class="rk rk-3">3</div>
                        <div class="p-ico" style="background:#1db954;border-color:#17a349">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#1db954" />
                                <path
                                    d="M24 12c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12S30.627 12 24 12zm5.25 17.25a.75.75 0 01-1.032.258c-2.82-1.728-6.372-2.118-10.554-1.158a.75.75 0 01-.336-1.464c4.578-1.05 8.502-.6 11.664 1.332a.75.75 0 01.258 1.032zm1.404-3.12a.938.938 0 01-1.29.312c-3.228-1.986-8.148-2.562-11.97-1.404a.938.938 0 01-.528-1.794c4.368-1.29 9.798-.654 13.476 1.596a.938.938 0 01.312 1.29zm.12-3.252c-3.87-2.298-10.254-2.508-13.944-1.386a1.125 1.125 0 01-.648-2.148c4.242-1.284 11.286-1.038 15.732 1.602a1.125 1.125 0 01-1.14 1.932z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div class="p-name">Spotify Premium</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 8.900</div>
                            <div class="p-sold">15K terjual</div>
                        </div>
                    </div>
                    <!-- Netflix -->
                    <div class="pcard" data-title="Netflix Premium" data-price="20900"
                        data-desc="Nonton film & series tanpa batas. Kualitas 4K Ultra HD. 4 layar sekaligus."
                        data-dur="1 Bulan">
                        <div class="p-ico" style="background:#e50914;border-color:#c0070f">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#e50914" /><text x="24" y="33"
                                    text-anchor="middle" font-size="20" font-weight="900" fill="white"
                                    font-family="Arial">N</text>
                            </svg>
                        </div>
                        <div class="p-name">Netflix Premium</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.8</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 20.900</div>
                            <div class="p-sold">9K terjual</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TRUST BADGES -->
            <div class="trust">
                <div class="trust-item">
                    <div class="trust-ico trust-ico-anim" style="background:rgba(16,185,129,.12);">
                        <svg class="shield-anim" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="trust-t">Garansi Penuh</div>
                        <div class="trust-s">Replace kalau ada masalah</div>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-ico" style="background:rgba(249,115,22,.12);">
                        <img src="https://cdn.zannstore.com/assets/project/zannstore.com/GIF/discount.webp"
                            alt="Proses Kilat" style="width:28px;height:28px;object-fit:contain;">
                    </div>
                    <div>
                        <div class="trust-t">Proses Kilat</div>
                        <div class="trust-s">Otomatis dalam 1-5 menit</div>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-ico" style="background:transparent;">
                        <img src="https://cdn.zannstore.com/assets/project/zannstore.com/GIF/chat.webp"
                            alt="CS Siap Bantu" style="width: 28px; height: 28px; object-fit: contain;">
                    </div>
                    <div>
                        <div class="trust-t">CS Siap Bantu</div>
                        <div class="trust-s">WA & Telegram 24 jam</div>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-ico" style="background:rgba(139,92,246,.12);">
                        <img src="https://cdn.zannstore.com/assets/project/zannstore.com/GIF/secure.webp" alt="QRIS"
                            style="width:28px;height:28px;object-fit:contain;">
                    </div>
                    <div>
                        <div class="trust-t">Bayar Mudah</div>
                        <div class="trust-s">QRIS, Bank, E-wallet</div>
                    </div>
                </div>
            </div>

            <!-- ALL PRODUCTS -->
            <div class="sec">
                <div class="sec-head">
                    <div class="sec-t">Semua Produk</div>
                </div>
                <div class="filters">
                    <button class="fltr on">Terlaris</button>
                    <button class="fltr">Termurah</button>
                    <button class="fltr">Terbaru</button>
                </div>
                <div class="pgrid">
                    <!-- Lightroom -->
                    <div class="pcard" data-title="Adobe Lightroom" data-price="29900"
                        data-desc="Edit foto profesional langsung dari HP. Preset premium dan fitur AI lengkap."
                        data-dur="1 Tahun">
                        <div class="p-ico"
                            style="background:linear-gradient(135deg,#001d3d,#003566);border-color:#003566">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#001d3d" /><text x="24" y="33"
                                    text-anchor="middle" font-size="18" font-weight="800" fill="#31a8ff"
                                    font-family="Arial">Lr</text>
                            </svg>
                        </div>
                        <div class="p-name">Adobe Lightroom</div>
                        <div class="p-dur">1 Tahun</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 29.900</div>
                            <div class="p-sold">8K terjual</div>
                        </div>
                    </div>
                    <!-- Alight Motion -->
                    <div class="pcard" data-title="Alight Motion" data-price="19900"
                        data-desc="Aplikasi edit video terbaik untuk Android. Bisa animasi, efek motion graphics, dan lebih."
                        data-dur="1 Tahun">
                        <div class="p-ico"
                            style="background:linear-gradient(135deg,#0f0c29,#302b63);border-color:#302b63">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#302b63" /><text x="24" y="33"
                                    text-anchor="middle" font-size="16" font-weight="800" fill="#00d2ff"
                                    font-family="Arial">Am</text>
                            </svg>
                        </div>
                        <div class="p-name">Alight Motion</div>
                        <div class="p-dur">1 Tahun</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 19.900</div>
                            <div class="p-sold">6K terjual</div>
                        </div>
                    </div>
                    <!-- YouTube -->
                    <div class="pcard" data-title="YouTube Premium" data-price="12900"
                        data-desc="Nonton tanpa iklan, bisa download video, YouTube Music gratis. Cocok banget buat pelajar."
                        data-dur="1 Bulan">
                        <span class="p-tag p-tag-hot">TRENDING</span>
                        <div class="p-ico" style="background:#ff0000;border-color:#cc0000">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#ff0000" />
                                <path d="M34.5 24L20 32V16l14.5 8z" fill="white" />
                            </svg>
                        </div>
                        <div class="p-name">YouTube Premium</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.9</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 12.900</div>
                            <div class="p-sold">10K terjual</div>
                        </div>
                    </div>
                    <!-- ChatGPT -->
                    <div class="pcard" data-title="ChatGPT Plus" data-price="89900"
                        data-desc="Akses GPT-4o, DALL-E, Advanced Data Analysis, dan fitur AI terkini dari OpenAI."
                        data-dur="1 Bulan">
                        <span class="p-tag p-tag-new">NEW</span>
                        <div class="p-ico" style="background:#10a37f;border-color:#0d8a6c">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#10a37f" /><text x="24" y="33"
                                    text-anchor="middle" font-size="18" font-weight="800" fill="white"
                                    font-family="Arial">AI</text>
                            </svg>
                        </div>
                        <div class="p-name">ChatGPT Plus</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.8</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 89.900</div>
                            <div class="p-sold">5K terjual</div>
                        </div>
                    </div>
                    <!-- Microsoft 365 -->
                    <div class="pcard" data-title="Microsoft 365" data-price="35000"
                        data-desc="Word, Excel, PowerPoint, 1TB OneDrive. Bisa dipakai di 5 perangkat sekaligus."
                        data-dur="1 Tahun">
                        <div class="p-ico"
                            style="background:linear-gradient(135deg,#0078d4,#005a9e);border-color:#005a9e">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#0078d4" /><text x="24" y="33"
                                    text-anchor="middle" font-size="14" font-weight="800" fill="white"
                                    font-family="Arial">365</text>
                            </svg>
                        </div>
                        <div class="p-name">Microsoft 365</div>
                        <div class="p-dur">1 Tahun</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.8</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 35.000</div>
                            <div class="p-sold">12K terjual</div>
                        </div>
                    </div>
                    <!-- Disney+ -->
                    <div class="pcard" data-title="Disney+ Hotstar" data-price="14900"
                        data-desc="Film Disney, Marvel, Star Wars, National Geographic. Streaming kualitas Full HD."
                        data-dur="1 Bulan">
                        <div class="p-ico"
                            style="background:linear-gradient(135deg,#002f6c,#0050b3);border-color:#0050b3">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#002f6c" /><text x="24" y="33"
                                    text-anchor="middle" font-size="17" font-weight="900" fill="white"
                                    font-family="Arial">D+</text>
                            </svg>
                        </div>
                        <div class="p-name">Disney+ Hotstar</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.7</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 14.900</div>
                            <div class="p-sold">7K terjual</div>
                        </div>
                    </div>
                    <!-- Grammarly -->
                    <div class="pcard" data-title="Grammarly Premium" data-price="25000"
                        data-desc="Koreksi grammar otomatis + saran penulisan AI. Wajib buat yang sering nulis Bahasa Inggris."
                        data-dur="1 Bulan">
                        <div class="p-ico" style="background:#15c39a;border-color:#12a885">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#15c39a" /><text x="24" y="33"
                                    text-anchor="middle" font-size="22" font-weight="800" fill="white"
                                    font-family="Arial">G</text>
                            </svg>
                        </div>
                        <div class="p-name">Grammarly Premium</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.7</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 25.000</div>
                            <div class="p-sold">3K terjual</div>
                        </div>
                    </div>
                    <!-- Zoom -->
                    <div class="pcard" data-title="Zoom Pro" data-price="15000"
                        data-desc="Meeting online tanpa batas waktu, rekam meeting, 100 peserta. Cocok buat bisnis & edukasi."
                        data-dur="1 Bulan">
                        <div class="p-ico" style="background:#2d8cff;border-color:#1a7ae0">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect width="48" height="48" rx="10" fill="#2d8cff" /><text x="24" y="33"
                                    text-anchor="middle" font-size="18" font-weight="800" fill="white"
                                    font-family="Arial">Z</text>
                            </svg>
                        </div>
                        <div class="p-name">Zoom Pro</div>
                        <div class="p-dur">1 Bulan</div>
                        <div class="p-rating"><svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg> 4.7</div>
                        <div class="p-bottom">
                            <div class="p-price">Rp 15.000</div>
                            <div class="p-sold">4K terjual</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            @include('components.footer')

        </div>
    </main>

    <div class="spacer"></div>

    <!-- PRODUCT MODAL -->
    <div class="modal-overlay" id="pModalOverlay"></div>
    <div class="modal-box" id="pModalBox">
        <button class="modal-close" id="pModalClose">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="width:16px;height:16px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- SCROLLABLE CONTENT -->
        <div class="m-scroll">
            <div class="m-head">
                <div class="m-ico" id="mIco"></div>
                <div class="m-head-info">
                    <div class="m-tag" id="mTag">PREMIUM APP</div>
                    <div class="m-title" id="mTitle">App Name</div>
                    <div class="m-dur" id="mDur">1 Bulan</div>
                    <div class="m-price" id="mPrice">Rp 5.000</div>
                </div>
            </div>

            <div class="m-stats">
                <div class="m-stat">
                    <div class="m-stat-i" style="background:rgba(16,185,129,.1);color:#10b981">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <div class="m-stat-t">Stok</div>
                        <div class="m-stat-v" style="color:#10b981">Ready</div>
                    </div>
                </div>
                <div class="m-stat">
                    <div class="m-stat-i" style="background:rgba(249,115,22,.1);color:#f97316">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="m-stat-t">Garansi</div>
                        <div class="m-stat-v">Full Replace</div>
                    </div>
                </div>
            </div>

            <div class="m-desc">
                <div class="m-desc-t">ℹ️ Deskripsi Produk</div>
                <div class="m-desc-c" id="mDesc">Support digunakan di semua Perangkat.</div>
            </div>

            <div class="m-buy">
                <div class="m-buy-label">
                    <div class="m-buy-t">Jumlah Beli</div>
                    <div class="m-qty-row">
                        <div class="m-qty-ctrl">
                            <button class="m-qty-btn" id="qtyMinus">−</button>
                            <input type="number" class="m-qty-val" value="1" min="1" id="qtyInput">
                            <button class="m-qty-btn" id="qtyPlus">+</button>
                        </div>
                    </div>
                </div>

                <div class="m-buy-t" style="margin-top:20px">Kirim ke WhatsApp / Telegram</div>
                <div class="m-buy-s">Akun premium akan dikirim ke nomor ini</div>
                <div class="m-inp-wrap">
                    <div class="m-inp-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" class="m-inp" id="waInput" placeholder="Contoh: 08123456789"
                        oninput="clearError(this)">
                </div>
                <div class="m-err" id="waErr">⚠️ Nomor WA / username Telegram wajib diisi dulu ya!</div>
            </div>
        </div>

        <!-- MODAL BOTTOM BAR -->
        <div class="m-bot" id="pModalBot">
            <div class="m-bot-l">
                <div class="m-bot-t">Total Bayar</div>
                <div class="m-bot-v" id="mTotal">Rp 5.000</div>
            </div>
            <button class="m-bot-btn" id="btnBuy">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Bayar Sekarang
            </button>
        </div>
    </div>

    <script>
        const cards = document.querySelectorAll('.pcard');
        const overlay = document.getElementById('pModalOverlay');
        const modal = document.getElementById('pModalBox');
        const closeBtn = document.getElementById('pModalClose');
        const qtyMinus = document.getElementById('qtyMinus');
        const qtyPlus = document.getElementById('qtyPlus');
        const qtyInput = document.getElementById('qtyInput');
        const waInput = document.getElementById('waInput');
        const waErr = document.getElementById('waErr');
        const btnBuy = document.getElementById('btnBuy');

        let basePrice = 5000;

        function formatRp(num) {
            return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateTotal() {
            const qty = parseInt(qtyInput.value) || 1;
            document.getElementById('mTotal').textContent = formatRp(basePrice * qty);
        }

        function clearError(el) {
            el.classList.remove('inp-error');
            waErr.style.display = 'none';
        }

        function openModal(card) {
            const title = card.dataset.title || card.querySelector('.p-name').textContent;
            const price = parseInt(card.dataset.price) || 5000;
            const desc = card.dataset.desc || 'Support semua perangkat.';
            const dur = card.dataset.dur || '1 Bulan';
            const icoHTML = card.querySelector('.p-ico').innerHTML;
            const icoStyle = card.querySelector('.p-ico').getAttribute('style') || '';

            document.getElementById('mTitle').textContent = title;
            document.getElementById('mPrice').textContent = formatRp(price);
            document.getElementById('mDur').textContent = dur;
            document.getElementById('mDesc').textContent = desc;
            document.getElementById('mTag').textContent = title.toUpperCase();

            const mIco = document.getElementById('mIco');
            mIco.innerHTML = icoHTML;
            mIco.setAttribute('style', icoStyle);

            basePrice = price;
            qtyInput.value = 1;
            waInput.value = '';
            waInput.classList.remove('inp-error');
            waErr.style.display = 'none';
            updateTotal();

            overlay.classList.add('show');
            setTimeout(() => { modal.classList.add('show'); }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }, 300);
        }

        cards.forEach(card => {
            card.addEventListener('click', () => openModal(card));
        });

        closeBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', closeModal);

        qtyMinus.addEventListener('click', () => {
            let v = parseInt(qtyInput.value) || 1;
            if (v > 1) { qtyInput.value = v - 1; updateTotal(); }
        });
        qtyPlus.addEventListener('click', () => {
            let v = parseInt(qtyInput.value) || 1;
            qtyInput.value = v + 1; updateTotal();
        });
        qtyInput.addEventListener('input', () => {
            let v = parseInt(qtyInput.value);
            if (v < 1 || isNaN(v)) qtyInput.value = 1;
            updateTotal();
        });

        btnBuy.addEventListener('click', () => {
            if (!waInput.value.trim()) {
                waInput.classList.add('inp-error', 'shake');
                waErr.style.display = 'block';
                setTimeout(() => waInput.classList.remove('shake'), 400);
                waInput.focus();
                return;
            }
            alert('✅ Pesanan diterima! Kami akan segera proses.');
        });

        // Category filter tabs
        document.querySelectorAll('.cat').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.cat').forEach(b => b.classList.remove('on'));
                this.classList.add('on');
            });
        });
        document.querySelectorAll('.fltr').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.fltr').forEach(b => b.classList.remove('on'));
                this.classList.add('on');
            });
        });

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

        themeToggle.addEventListener('click', function () {
            const isLight = html.classList.contains('light');
            applyTheme(isLight ? 'dark' : 'light');

            // Animasi pulse pada tombol
            this.classList.add('theme-pulse');
            setTimeout(() => this.classList.remove('theme-pulse'), 400);
        });

        // Init tema dari localStorage
        const savedTheme = localStorage.getItem('zann-theme') || 'dark';
        applyTheme(savedTheme);
    </script>

    <!-- BOTTOM NAV -->
    @include('components.bottom-nav')
</body>

</html>