@php
    $profil = \App\Models\Profil::first();
@endphp
<!-- Header Top Section Start -->
<div class="header-top-section">
    <div class="container-fluid">
        <div class="header-top-wrapper">
            <ul class="contact-list">
                <li>
                    <i class="far fa-envelope"></i>
                    <a href="mailto:{{ $profil->email_perusahaan }}" class="link">{{ $profil->email_perusahaan }}</a>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $profil->alamat_perusahaan }}
                </li>
            </ul>
            @if ($profil->facebook_perusahaan || $profil->twitter_perusahaan || $profil->instagram_perusahaan || $profil->linkedin_perusahaan)
            <div class="header-top-right">
                <div class="social-icon d-flex align-items-center">
                    @if ($profil->facebook_perusahaan)
                        <a href="{{ $profil->facebook_perusahaan }}"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ($profil->twitter_perusahaan)
                        <a href="{{ $profil->twitter_perusahaan }}"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if ($profil->instagram_perusahaan)
                        <a href="{{ $profil->instagram_perusahaan }}"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if ($profil->linkedin_perusahaan)
                        <a href="{{ $profil->linkedin_perusahaan }}"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Header Area Start -->
<header class="header-section-1">
    <div id="header-sticky" class="header-1">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="header-left">
                        <div class="logo">
                            <a href="{{ route('landing') }}" class="header-logo">
                                <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" width="auto"
                                    height="50" alt="logo-img">
                            </a>
                        </div>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="has-dropdown active menu-thumb">
                                        <a href="{{ route('landing') }}">
                                            Beranda
                                        </a>
                                    </li>
                                    <li class="has-dropdown active d-xl-none">
                                        <a href="{{ route('landing') }}" class="border-top-none">
                                            Beranda
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">Tentang Kami</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('layanan') }}">Layanan </a>

                                    </li>
                                    <li class="has-dropdown active">
                                        <a href="{{ route('shop') }}">Belanja</a>

                                    </li>
                                    <li>
                                        <a href="{{ route('kontak.index') }}">Kontak</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                        @auth
                            <div class="dropdown">
                                <a href="#" class="user-icon dropdown-toggle" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profil') }}"><i
                                                class="far fa-user me-2"></i>Profil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('riwayat-pesanan.index') }}"><i
                                                class="far fa-shopping-bag me-2"></i>Riwayat Pesanan</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a href="/logout" class="dropdown-item">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="dropdown">
                                <a href="#" class="user-icon dropdown-toggle" id="guestDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="guestDropdown">
                                    <li>
                                        <a href="{{ route('login') }}" class="dropdown-item"><i
                                                class="far fa-sign-in-alt me-1"></i> Login</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register') }}" class="dropdown-item"><i
                                                class="fas fa-user-plus me-1"></i> Register</a>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                        @auth
                            <div class="menu-cart position-relative">
                                <button id="openButton">
                                    <i class="far fa-shopping-cart"></i>
                                    <span id="cartBadge"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size:11px;min-width:20px;">
                                        <span id="cartCount">0</span>
                                    </span>
                                </button>
                            </div>
                        @endauth
                        @auth
                            <script>
                                function updateCartBadge() {
                                    fetch('{{ route('keranjang.get') }}', {
                                            method: 'GET',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            const badge = document.getElementById('cartBadge');
                                            const count = document.getElementById('cartCount');
                                            if (data.items && data.items.length > 0) {
                                                let totalQty = 0;
                                                data.items.forEach(item => {
                                                    totalQty += item.quantity;
                                                });
                                                count.textContent = totalQty;
                                                badge.style.display = 'inline-block';
                                            } else {
                                                count.textContent = 0;
                                                badge.style.display = 'none';
                                            }
                                        })
                                        .catch(() => {
                                            // Hide badge on error
                                            const badge = document.getElementById('cartBadge');
                                            if (badge) badge.style.display = 'none';
                                        });
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    updateCartBadge();

                                    // After adding to cart via detail page, reload badge
                                    document.addEventListener('cart:updated', function() {
                                        updateCartBadge();
                                    });

                                    // Optionally, update after sidebar is closed or cart is updated elsewhere
                                });
                            </script>
                        @endauth
                        <div class="header__hamburger d-xl-none align-self-center">
                            <div class="sidebar__toggle">
                                <img src="{{ asset('web') }}/assets/img/toggle.svg" width="20" height="20"
                                    alt="img" style="position: relative; top: -2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
