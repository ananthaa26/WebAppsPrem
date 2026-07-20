<nav class="bnav">
    <div class="bnav-inner">
        <a href="/" class="bn {{ request()->is('/') ? 'on' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Home
        </a>

        <a href="/pesanan" class="bn {{ request()->is('pesanan') ? 'on' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Pesanan
        </a>
        @auth
        <a href="/akun" class="bn {{ request()->is('akun') || request()->is('auth') ? 'on' : '' }}">
            @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar }}" alt="Profile" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; margin-bottom: 2px;">
            @else
                <div style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; margin-bottom: 2px;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            @endif
            Akun
        </a>
        @else
        <a href="/auth" class="bn {{ request()->is('akun') || request()->is('auth') ? 'on' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Akun
        </a>
        @endauth
    </div>
</nav>
