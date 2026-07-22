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
        .quick-btn {
            background: var(--bg-main);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 12px 10px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .quick-btn:hover, .quick-btn.active {
            background: rgba(255, 65, 108, 0.1);
            border-color: #ff416c;
            color: #ff416c;
        }
        .form-input:focus {
            border-color: #ff416c !important;
            box-shadow: 0 0 0 3px rgba(255,65,108,0.1);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,65,108,0.4);
        }
        /* Responsiveness for grid */
        @media(max-width: 480px) {
            .quick-nominals {
                grid-template-columns: repeat(2, 1fr) !important;
            }
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
                    <div class="deposit-title">Isi Saldo (Deposit)</div>
                    <div class="deposit-desc" style="margin-bottom: 25px;">Pilih nominal cepat atau masukkan jumlah saldo yang ingin Anda isi.</div>
                    
                    <form action="/akun/deposit/checkout" method="POST" id="depositForm">
                        @csrf
                        <div class="input-group" style="margin-bottom: 20px; text-align: left;">
                            <label for="nominal" style="display: block; font-weight: 600; margin-bottom: 10px; color: var(--text-main);">Nominal Deposit</label>
                            <div class="input-wrapper" style="position: relative; display: flex; align-items: center;">
                                <span style="position: absolute; left: 15px; font-weight: 600; color: var(--text-muted);">Rp</span>
                                <input type="number" id="nominal" name="nominal" class="form-input" style="width: 100%; padding: 12px 15px 12px 45px; border-radius: 12px; border: 1px solid var(--border-color); background: var(--bg-main); color: var(--text-main); font-size: 16px; outline: none; transition: 0.3s;" placeholder="0" required min="10000">
                            </div>
                            <small style="color: var(--text-muted); display: block; margin-top: 5px; font-size: 12px;">Minimal deposit Rp 10.000</small>
                        </div>

                        <div class="quick-nominals" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 25px;">
                            <button type="button" class="quick-btn" data-val="10000">10.000</button>
                            <button type="button" class="quick-btn" data-val="20000">20.000</button>
                            <button type="button" class="quick-btn" data-val="50000">50.000</button>
                            <button type="button" class="quick-btn" data-val="100000">100.000</button>
                            <button type="button" class="quick-btn" data-val="500000">500.000</button>
                            <button type="button" class="quick-btn" data-val="1000000">1.000.000</button>
                        </div>

                        <button type="submit" class="submit-btn" style="width: 100%; padding: 14px; border-radius: 12px; background: linear-gradient(135deg, #ff416c, #ff4b2b); color: #fff; font-weight: 700; font-size: 16px; border: none; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;">Lanjutkan Pembayaran</button>
                    </form>
                </div>

                <div class="deposit-card" style="margin-top: 20px; text-align: left;">
                    <h3 style="font-size: 18px; margin-bottom: 20px; color: var(--text-main);">Riwayat Deposit Saldo</h3>
                    @if($deposits->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 12px;">
                            @foreach($deposits as $dep)
                            <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); padding: 16px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="font-weight: 600; font-size: 14px; color: var(--text-main);">{{ $dep->invoice_number }}</div>
                                    @if($dep->status === 'completed')
                                        <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Selesai</div>
                                    @elseif($dep->status === 'failed')
                                        <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Gagal</div>
                                    @else
                                        <div style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 4px 10px; border-radius: 10px; font-size: 11px; font-weight: 600;">Menunggu</div>
                                    @endif
                                </div>
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <div style="width: 40px; height: 40px; background: rgba(255, 65, 108, 0.1); color: #ff416c; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                                        💰
                                    </div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: var(--text-main); font-size: 13px;">Top Up via {{ strtoupper($dep->payment_method ?? 'QRIS') }}</div>
                                        <div style="font-size: 12px; color: var(--text-muted);"><span class="local-time" data-timestamp="{{ $dep->created_at->timestamp }}">{{ $dep->created_at->format('d M Y, H:i') }} WIB</span> • Rp {{ number_format($dep->amount, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                @if($dep->checkout_url)
                                <div style="margin-top: 8px; padding-top: 8px; border-top: 1px dashed var(--border-color); text-align: right;">
                                    <a href="{!! $dep->checkout_url !!}" style="color: #ff416c; font-size: 12px; font-weight: 600; text-decoration: none;">Cek Detail ➔</a>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        
                        @if($deposits->hasPages())
                            <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; gap: 5px;">
                                @if ($deposits->onFirstPage())
                                    <div style="padding: 6px 12px; border-radius: 8px; background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-muted); opacity: 0.5; font-size: 12px; font-weight: 600; user-select: none; white-space: nowrap;">&laquo; Prev</div>
                                @else
                                    <a href="{{ $deposits->previousPageUrl() }}" style="padding: 6px 12px; border-radius: 8px; background: rgba(255, 65, 108, 0.1); color: #ff416c; border: 1px solid rgba(255, 65, 108, 0.2); text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.2s; white-space: nowrap;">&laquo; Prev</a>
                                @endif

                                <div style="font-size: 11px; color: var(--text-muted); font-weight: 600; white-space: nowrap; text-align: center;">
                                    Hal {{ $deposits->currentPage() }} / {{ $deposits->lastPage() }}
                                </div>

                                @if ($deposits->hasMorePages())
                                    <a href="{{ $deposits->nextPageUrl() }}" style="padding: 6px 12px; border-radius: 8px; background: rgba(255, 65, 108, 0.1); color: #ff416c; border: 1px solid rgba(255, 65, 108, 0.2); text-decoration: none; font-size: 12px; font-weight: 600; transition: all 0.2s; white-space: nowrap;">Next &raquo;</a>
                                @else
                                    <div style="padding: 6px 12px; border-radius: 8px; background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-muted); opacity: 0.5; font-size: 12px; font-weight: 600; user-select: none; white-space: nowrap;">Next &raquo;</div>
                                @endif
                            </div>
                        @endif
                    @else
                        <div style="text-align: center; padding: 30px; color: var(--text-muted); font-size: 14px;">Belum ada deposit.</div>
                    @endif
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

        // Logic for Quick Nominal Buttons
        document.addEventListener('DOMContentLoaded', function() {
            const nominalInput = document.getElementById('nominal');
            const quickBtns = document.querySelectorAll('.quick-btn');

            quickBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active from all
                    quickBtns.forEach(b => b.classList.remove('active'));
                    // Add active to clicked
                    this.classList.add('active');
                    // Set value
                    nominalInput.value = this.getAttribute('data-val');
                });
            });

            nominalInput.addEventListener('input', function() {
                quickBtns.forEach(b => b.classList.remove('active'));
                const val = this.value;
                quickBtns.forEach(btn => {
                    if(btn.getAttribute('data-val') === val) {
                        btn.classList.add('active');
                    }
                });
            });
        });
    </script>

    @if(session('checkout_url'))
    <script>
        setTimeout(function() {
            window.location.href = "{!! session('checkout_url') !!}";
        }, 5000);
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.local-time').forEach(function(el) {
                var ts = parseInt(el.getAttribute('data-timestamp')) * 1000;
                var date = new Date(ts);
                var options = { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit', timeZoneName: 'short' };
                el.innerText = date.toLocaleString('id-ID', options).replace(/\./g, ':');
            });
        });
    </script>
</body>
</html>
