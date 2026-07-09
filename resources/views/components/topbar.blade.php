<!-- TOP BAR -->
<header class="topbar">
    <div class="w">
        <div class="topbar-inner">
            <a href="/" class="logo-link">
                <img src="https://cdn.zannstore.com/assets/project/zannstore/2022profileBrand.webp" alt="ZANNSTORE"
                    class="logo-img">
            </a>
            <nav class="topbar-nav">
                <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="/pesanan">Transaksi</a>
                <a href="/hubungi-kami" class="{{ request()->is('hubungi-kami') ? 'active' : '' }}">Bantuan</a>
            </nav>
            <div class="topbar-right">
                <button class="tb theme-toggle" id="themeToggle" aria-label="Toggle tema">
                    <!-- Moon icon (dark mode aktif) -->
                    <svg class="icon-moon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                    <!-- Sun icon (light mode aktif) -->
                    <svg class="icon-sun" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>