<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZANNSTORE — Langganan Premium Murah</title>
    <meta name="description"
        content="Beli langganan premium murah, aman, proses otomatis. Spotify, Netflix, Canva, CapCut dan lainnya.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .modal-overlay {
            z-index: 9999 !important;
        }
        .modal-box {
            z-index: 10000 !important;
        }
        @media (max-width: 768px) {
            .modal-box {
                max-height: 75vh !important;
            }
            .m-scroll {
                padding-bottom: 50px !important;
            }
        }
    </style>
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
    <style>
        /* SEARCH OVERLAY & RESULTS */
        html {
            scroll-behavior: smooth;
        }

        .search-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            z-index: 200;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s ease;
            pointer-events: none;
        }

        .search-overlay.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .search-wrap {
            position: relative;
            z-index: 300;
            /* Always above overlay */
        }

        .search-box {
            position: relative;
            z-index: 300;
        }

        .search-results {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            right: 0;
            background: #1e1e1e;
            border: 1px solid #333;
            border-radius: 16px;
            padding: 8px;
            max-height: 400px;
            overflow-y: auto;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            z-index: 300;
        }

        .search-results.show {
            display: block;
        }

        .s-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            cursor: pointer;
            border-radius: 10px;
            transition: background 0.15s;
        }

        .s-item:last-child {
            border-bottom: none;
        }

        .s-item:hover {
            background: rgba(255, 255, 255, 0.07);
        }

        .s-ico {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .s-ico img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .s-ico svg {
            width: 44px;
            height: 44px;
        }

        .s-info {
            flex: 1;
        }

        .s-cat {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #f97316;
            margin-bottom: 2px;
        }

        .s-title {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .s-price {
            color: #aaa;
            font-size: 12px;
            font-weight: 600;
            margin-top: 2px;
        }

        .s-empty {
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        html.light .search-results {
            background: #fff;
            border-color: #e5e5e5;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        html.light .s-item {
            border-bottom-color: #f0f0f0;
        }

        html.light .s-item:hover {
            background: #f5f5f5;
        }

        html.light .s-title {
            color: #111;
        }

        html.light .s-price {
            color: #666;
        }
    </style>
</head>

<body>
    <div class="search-overlay" id="searchOverlay"></div>

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
                    <input type="text" placeholder="Cari produk..." id="search-input" autocomplete="off">
                </div>
                <div class="search-results" id="searchResults"></div>
            </div>

            <!-- HERO BANNER -->
            <div class="hero-banner">
                <img src="/images/banner.webp" alt="Banner Promo" class="hero-banner-img">
            </div>



            <!-- BEST SELLER -->
            <div class="sec">
                <div class="sec-head">
                    <div class="sec-t">
                        <img src="https://cdn.zannstore.com/assets/project/zannstore.com/GIF/fire.webp"
                            alt="Best Seller" class="sec-icon">
                        Best Seller
                    </div>
                    <a href="#semua_product" class="sec-more">Lihat Semua →</a>
                </div>
                <div class="pgrid">
                    @forelse($bestsellers as $index => $product)
                        @php
                            $firstVariant = $product->variants->first();
                            $price = $firstVariant ? $firstVariant->price : 0;
                            $stock = $firstVariant ? $firstVariant->stock : 0;

                            $duration = '1 Bulan';
                            if ($firstVariant) {
                                $days = $firstVariant->duration_days;
                                if ($days == 365) {
                                    $duration = '12 Bulan';
                                } elseif ($days % 30 == 0) {
                                    $duration = ($days / 30) . ' Bulan';
                                } else {
                                    $duration = $days . ' Hari';
                                }
                            }
                        @endphp
                        <div class="pcard" data-title="{{ $product->name }}" data-price="{{ $price }}"
                            data-product-id="{{ $product->id }}" data-variant-id="{{ $firstVariant ? $firstVariant->id : '' }}"
                            data-desc="{{ $product->description }}" data-dur="{{ $duration }}"
                            data-cat-name="{{ $product->category->name ?? 'PREMIUM APP' }}" data-bestseller="true"
                            data-stock="{{ $stock }}">
                            @if($index < 3)
                                <div class="rk rk-{{ $index + 1 }}">{{ $index + 1 }}</div>
                            @endif
                            @if($firstVariant && $firstVariant->label)
                                <span class="p-tag p-tag-hot">{{ strtoupper($firstVariant->label) }}</span>
                            @endif
                            <div class="p-ico" style="background:#000;border-color:#333">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                                @else
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <rect width="48" height="48" rx="10" fill="#000" />
                                        <path d="M14 24l10-6v5l10-5v12l-10-5v5L14 24z" fill="white" />
                                    </svg>
                                @endif
                            </div>
                            <div class="p-name">{{ $product->name }}</div>
                            <div class="p-dur">{{ $duration }}</div>
                            <div class="p-rating"><svg viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg> {{ number_format($product->average_rating, 1) }}</div>
                            <div class="p-bottom">
                                <div class="p-price">Rp {{ number_format($price, 0, ',', '.') }}</div>
                                <div class="p-sold">
                                    {{ $product->total_sold ? number_format($product->total_sold, 0, ',', '.') : 0 }}
                                    terjual
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: #999; text-align: center; width: 100%; padding: 20px;">Belum ada produk best
                            seller.</p>
                    @endforelse
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
            <div class="sec" id="semua_product">
                <div class="sec-head">
                    <div class="sec-t">Semua Produk</div>
                </div>

                <!-- CATEGORY FILTER -->
                <div class="cats" style="margin-bottom: 20px;">
                    <button class="cat on" data-cat="all">Semua</button>
                    @foreach($categories as $category)
                        <button class="cat" data-cat="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>

                <div class="filters" style="display:none;">
                    <button class="fltr on">Terlaris</button>
                    <button class="fltr">Termurah</button>
                    <button class="fltr">Terbaru</button>
                </div>
                <div class="pgrid" id="allProductsGrid">
                    @forelse($products as $product)
                        @php
                            $firstVariant = $product->variants->first();
                            $price = $firstVariant ? $firstVariant->price : 0;
                            $stock = $firstVariant ? $firstVariant->stock : 0;

                            $duration = '1 Bulan';
                            if ($firstVariant) {
                                $days = $firstVariant->duration_days;
                                if ($days == 365) {
                                    $duration = '12 Bulan';
                                } elseif ($days % 30 == 0) {
                                    $duration = ($days / 30) . ' Bulan';
                                } else {
                                    $duration = $days . ' Hari';
                                }
                            }
                        @endphp
                        <div class="pcard all-pcard" data-cat="{{ $product->category_id }}"
                            data-title="{{ $product->name }}" data-price="{{ $price }}"
                            data-product-id="{{ $product->id }}" data-variant-id="{{ $firstVariant ? $firstVariant->id : '' }}"
                            data-desc="{{ $product->description }}" data-dur="{{ $duration }}"
                            data-cat-name="{{ $product->category->name ?? 'PREMIUM APP' }}"
                            data-bestseller="{{ $product->is_bestseller ? 'true' : 'false' }}" data-stock="{{ $stock }}">
                            @if($firstVariant && $firstVariant->label)
                                <span class="p-tag p-tag-hot">{{ strtoupper($firstVariant->label) }}</span>
                            @endif
                            <div class="p-ico"
                                style="background:linear-gradient(135deg,#001d3d,#003566);border-color:#003566">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                                @else
                                    <svg viewBox="0 0 48 48" fill="none">
                                        <rect width="48" height="48" rx="10" fill="#001d3d" /><text x="24" y="33"
                                            text-anchor="middle" font-size="18" font-weight="800" fill="#31a8ff"
                                            font-family="Arial">{{ substr($product->name, 0, 1) }}</text>
                                    </svg>
                                @endif
                            </div>
                            <div class="p-name">{{ $product->name }}</div>
                            <div class="p-dur">{{ $duration }}</div>
                            <div class="p-rating"><svg viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg> {{ number_format($product->average_rating, 1) }}</div>
                            <div class="p-bottom">
                                <div class="p-price">Rp {{ number_format($price, 0, ',', '.') }}</div>
                                <div class="p-sold">
                                    {{ $product->total_sold ? number_format($product->total_sold, 0, ',', '.') : 0 }}
                                    terjual
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: #999; text-align: center; width: 100%; padding: 20px;">Belum ada produk.</p>
                    @endforelse
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
                        <div class="m-stat-v" id="mStockText" style="color:#10b981">Ready</div>
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

                <div class="m-buy-t" style="margin-top:20px">Tujuan Pengiriman</div>
                <div style="display: flex; gap: 10px; margin-top: 5px; margin-bottom: 10px;">
                    <label style="flex: 1; border: 2px solid #ff416c; padding: 10px; border-radius: 8px; text-align: center; cursor: pointer; display: flex; justify-content: center; align-items: center; background: rgba(255, 65, 108, 0.1);" class="contact-opt">
                        <input type="radio" name="contact_method" value="wa" checked style="display: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" style="width: 28px; height: 28px; object-fit: contain;">
                    </label>
                    <label style="flex: 1; border: 1px solid var(--border-color); padding: 10px; border-radius: 8px; text-align: center; cursor: pointer; display: flex; justify-content: center; align-items: center; background: transparent;" class="contact-opt">
                        <input type="radio" name="contact_method" value="email" style="display: none;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Gmail_icon_%282020%29.svg" alt="Email" style="width: 28px; height: 28px; object-fit: contain;">
                    </label>
                </div>
                <div class="m-inp-wrap">
                    <div class="m-inp-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="number" class="m-inp" id="waInput" placeholder="Contoh: 08123456789"
                        oninput="clearError(this)">
                </div>
                <div class="m-err" id="waErr">⚠️ Nomor WA / Email wajib diisi dulu ya!</div>
                
                <div class="m-buy-t" style="margin-top:20px">Metode Pembayaran</div>
                <div class="m-buy-s">Pilih cara kamu membayar pesanan ini</div>
                <div style="display: flex; gap: 10px; margin-top: 10px;" id="pmContainer">
                    <label style="flex: 1; border: 2px solid #ff416c; padding: 12px; border-radius: 12px; text-align: center; cursor: pointer; display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 5px; background: rgba(255, 65, 108, 0.1);" class="pm-opt">
                        <input type="radio" name="payment_method" value="qris" checked style="display: none;">
                        <div style="background: #ffffff; padding: 3px 6px; border-radius: 6px; display: flex; justify-content: center; align-items: center;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" style="width: 54px; height: 22px; object-fit: contain;">
                        </div>
                        <span style="font-size: 13px; font-weight: 600; color: var(--text-main);">QRIS (Semua E-Wallet)</span>
                    </label>
                    <label style="flex: 1; border: 1px solid var(--border-color); padding: 12px; border-radius: 12px; text-align: center; cursor: {{ auth()->check() ? 'pointer' : 'not-allowed' }}; opacity: {{ auth()->check() ? '1' : '0.5' }}; display: flex; flex-direction: column; justify-content: center; align-items: center; gap: 5px;" class="pm-opt" {{ !auth()->check() ? 'onclick="event.preventDefault(); showToast(\'Silakan login terlebih dahulu untuk menggunakan Saldo Akun.\', \'error\');"' : '' }}>
                        <input type="radio" name="payment_method" value="saldo" style="display: none;" {{ auth()->check() ? '' : 'disabled' }}>
                        <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/>
                            <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/>
                            <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/>
                        </svg>
                        <span style="font-size: 13px; font-weight: 600; color: var(--text-main);">Saldo Akun</span>
                        @if(!auth()->check())
                        <span style="font-size: 10px; color: #ef4444;">(Wajib Login)</span>
                        @endif
                    </label>
                </div>
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
        let selectedProductId = null;
        let selectedVariantId = null;

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
            
            const contactMethod = document.querySelector('input[name="contact_method"]:checked').value;
            if (contactMethod === 'wa') {
                el.value = el.value.replace(/[^0-9]/g, '');
            }
        }

        function openModal(card) {
            selectedProductId = card.dataset.productId;
            selectedVariantId = card.dataset.variantId;
            const title = card.dataset.title || card.querySelector('.p-name').textContent;
            const price = parseInt(card.dataset.price) || 5000;
            const desc = card.dataset.desc || 'Support semua perangkat.';
            const dur = card.dataset.dur || '1 Bulan';
            const catName = card.dataset.catName || 'PREMIUM APP';
            const stock = parseInt(card.dataset.stock) || 0;
            const icoHTML = card.querySelector('.p-ico').innerHTML;
            const icoStyle = card.querySelector('.p-ico').getAttribute('style') || '';

            document.getElementById('mTitle').textContent = title;
            document.getElementById('mPrice').textContent = formatRp(price);
            document.getElementById('mDur').textContent = dur;
            document.getElementById('mDesc').textContent = desc;
            document.getElementById('mTag').textContent = catName.toUpperCase();

            const stockTextEl = document.getElementById('mStockText');
            if (stock > 0) {
                stockTextEl.textContent = stock + ' tersedia';
                stockTextEl.style.color = '#10b981';
            } else {
                stockTextEl.textContent = 'Habis';
                stockTextEl.style.color = '#ef4444';
            }

            const mIco = document.getElementById('mIco');
            mIco.innerHTML = icoHTML;
            mIco.setAttribute('style', icoStyle);

            basePrice = price;
            qtyInput.max = stock;
            if (stock <= 0) {
                qtyInput.value = 0;
                qtyInput.min = 0;
                qtyMinus.disabled = true;
                qtyPlus.disabled = true;
                qtyInput.disabled = true;
                btnBuy.disabled = true;
                btnBuy.style.opacity = '0.5';
                btnBuy.style.pointerEvents = 'none';
            } else {
                qtyInput.value = 1;
                qtyInput.min = 1;
                qtyMinus.disabled = false;
                qtyPlus.disabled = false;
                qtyInput.disabled = false;
                btnBuy.disabled = false;
                btnBuy.style.opacity = '1';
                btnBuy.style.pointerEvents = 'auto';
            }
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
            let max = parseInt(qtyInput.max) || 0;
            if (v < max) { qtyInput.value = v + 1; updateTotal(); }
        });
        qtyInput.addEventListener('input', () => {
            let v = parseInt(qtyInput.value);
            let max = parseInt(qtyInput.max) || 0;
            if (max <= 0) {
                qtyInput.value = 0;
            } else if (v < 1 || isNaN(v)) {
                qtyInput.value = 1;
            } else if (v > max) {
                qtyInput.value = max;
            }
            updateTotal();
        });

        // Payment Method styling
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.pm-opt').forEach(opt => {
                    opt.style.border = '1px solid var(--border-color)';
                    opt.style.background = 'transparent';
                });
                if (this.checked) {
                    this.parentElement.style.border = '2px solid #ff416c';
                    this.parentElement.style.background = 'rgba(255, 65, 108, 0.1)';
                }
            });
        });

        // Contact Method styling & placeholder
        document.querySelectorAll('input[name="contact_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.contact-opt').forEach(opt => {
                    opt.style.border = '1px solid var(--border-color)';
                    opt.style.background = 'transparent';
                });
                if (this.checked) {
                    this.parentElement.style.border = '2px solid #ff416c';
                    this.parentElement.style.background = 'rgba(255, 65, 108, 0.1)';
                    
                    if (this.value === 'wa') {
                        waInput.type = 'number';
                        waInput.placeholder = 'Contoh: 08123456789';
                        waErr.innerText = '⚠️ Nomor WA wajib diisi dulu ya!';
                    } else {
                        waInput.type = 'email';
                        waInput.placeholder = 'Contoh: email@domain.com';
                        waErr.innerText = '⚠️ Email wajib diisi dulu ya!';
                    }
                }
            });
        });

        btnBuy.addEventListener('click', () => {
            const isAuth = {{ auth()->check() ? 'true' : 'false' }};
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (paymentMethod === 'saldo' && !isAuth) {
                showToast('Silakan login terlebih dahulu untuk menggunakan Saldo.', 'error');
                setTimeout(() => {
                    window.location.href = '/auth';
                }, 2000);
                return;
            }

            if (!waInput.value.trim()) {
                waInput.classList.add('inp-error', 'shake');
                waErr.style.display = 'block';
                setTimeout(() => waInput.classList.remove('shake'), 400);
                waInput.focus();
                return;
            }
            
            btnBuy.disabled = true;
            btnBuy.innerHTML = 'Memproses...';

            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: selectedProductId,
                    variant_id: selectedVariantId,
                    quantity: parseInt(qtyInput.value) || 1,
                    customer_contact: waInput.value.trim(),
                    payment_method: paymentMethod
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    // Close product modal
                    closeModal();
                    
                    if (paymentMethod === 'qris' && data.checkout_url) {
                        showToast('Memproses ke pembayaran QRIS...', 'success');
                        setTimeout(() => {
                            window.location.href = data.checkout_url;
                        }, 2000);
                    } else {
                        showToast('Pembelian Berhasil! Mengarahkan ke detail pesanan...', 'success');
                        setTimeout(() => {
                            window.location.href = '/pesanan?invoice=' + data.invoice;
                        }, 3000);
                    }
                } else if (data.message === 'Unauthenticated.') {
                    showToast('Silakan login terlebih dahulu untuk membeli produk.', 'error');
                    setTimeout(() => {
                        window.location.href = '/auth';
                    }, 2000);
                } else {
                    showToast(data.message || 'Terjadi kesalahan.', 'error');
                    btnBuy.disabled = false;
                    btnBuy.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> Bayar Sekarang';
                }
            })
            .catch(err => {
                showToast('Terjadi kesalahan pada server. Coba lagi nanti.', 'error');
                console.error(err);
                btnBuy.disabled = false;
                btnBuy.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> Bayar Sekarang';
            });
        });

        // Category filter tabs
        document.querySelectorAll('.cat').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.cat').forEach(b => b.classList.remove('on'));
                this.classList.add('on');

                const catId = this.getAttribute('data-cat');
                const allCards = document.querySelectorAll('.all-pcard');

                allCards.forEach(card => {
                    if (catId === 'all') {
                        card.style.display = 'flex';
                    } else {
                        if (card.getAttribute('data-cat') === catId) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
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

        // ===== SEARCH LOGIC =====
        const searchInput = document.getElementById('search-input');
        const searchOverlay = document.getElementById('searchOverlay');
        const searchResults = document.getElementById('searchResults');
        let allProductsData = [];

        // Collect all products from DOM on load (including bestsellers too)
        document.querySelectorAll('.pcard').forEach(card => {
            if (!card.dataset.title) return;
            // avoid duplicates
            if (allProductsData.find(p => p.title === card.dataset.title)) return;
            allProductsData.push({
                title: card.dataset.title,
                price: card.dataset.price,
                catName: card.dataset.catName || '',
                icoHTML: card.querySelector('.p-ico') ? card.querySelector('.p-ico').innerHTML : '',
                icoStyle: card.querySelector('.p-ico') ? card.querySelector('.p-ico').getAttribute('style') || '' : '',
                isBestseller: card.dataset.bestseller === 'true',
                element: card
            });
        });

        function openSearchOverlay() {
            searchOverlay.classList.add('show');
            searchResults.classList.add('show');
            renderSearch(searchInput.value);
        }

        function closeSearchOverlay() {
            searchOverlay.classList.remove('show');
            searchResults.classList.remove('show');
        }

        searchInput.addEventListener('focus', openSearchOverlay);
        searchInput.addEventListener('click', (e) => e.stopPropagation());

        // Clicking on the overlay (not search-wrap) closes it
        searchOverlay.addEventListener('click', closeSearchOverlay);

        searchInput.addEventListener('input', (e) => {
            renderSearch(e.target.value);
        });

        function renderSearch(query) {
            query = (query || '').toLowerCase().trim();
            searchResults.innerHTML = '';

            const filtered = query === ''
                ? allProductsData.filter(p => p.isBestseller)
                : allProductsData.filter(p =>
                    p.title.toLowerCase().includes(query) ||
                    (p.catName && p.catName.toLowerCase().includes(query))
                );

            if (filtered.length === 0) {
                searchResults.innerHTML = '<div class="s-empty">Produk tidak ditemukan 🔍</div>';
                return;
            }

            filtered.forEach(p => {
                const item = document.createElement('div');
                item.className = 's-item';
                item.innerHTML = `
                    <div class="s-ico" style="${p.icoStyle}">${p.icoHTML}</div>
                    <div class="s-info">
                        ${p.catName ? `<div class="s-cat">${p.catName}</div>` : ''}
                        <div class="s-title">${p.title}</div>
                        <div class="s-price">${formatRp(parseInt(p.price) || 0)}</div>
                    </div>
                `;
                // Use mousedown so click fires before blur
                item.addEventListener('mousedown', (e) => {
                    e.preventDefault(); // prevent input blur
                    closeSearchOverlay();
                    searchInput.value = '';
                    openModal(p.element);
                });
                searchResults.appendChild(item);
            });
        }
    </script>

    <!-- BOTTOM NAV -->
    @include('components.alert')
    @include('components.bottom-nav')
</body>

</html>