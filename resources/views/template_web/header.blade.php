@php
    $profil = \App\Models\Profil::first();
    $kategoris = \App\Models\ManageKategori::orderBy('nama_kategori')->get();
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
                <div class="header-main d-flex align-items-center">
                    <div class="header-left flex-shrink-0">
                        <div class="logo">
                            <a href="https://giaprint.id/" target="_blank" class="header-logo">
                                <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" width="auto"
                                    height="50" alt="logo-img">
                            </a>
                        </div>
                    </div>
                    <div class="mean__menu-wrapper flex-shrink-0">
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
                    <!-- Search Form - Desktop -->
                    <div class="header-search d-none d-lg-flex align-items-center flex-grow-1">
                        <form action="{{ route('shop') }}" method="GET" class="header-search-form">
                            <div class="search-input-wrapper">
                                <input type="text" 
                                       name="search" 
                                       class="form-control search-input" 
                                       placeholder="Cari produk..." 
                                       value="{{ request('search') }}">
                            </div>
                            <select name="kategori" class="form-select search-select" id="headerKategoriSelect">
                                <option value="">Semua Kategori</option>
                                @if(isset($kategoris) && $kategoris && $kategoris->count() > 0)
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Belum ada kategori</option>
                                @endif
                            </select>
                            <button type="submit" class="btn btn-primary search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center flex-shrink-0">
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
                            <button type="button" class="sidebar__toggle mobile-menu-btn" aria-label="Toggle Menu">
                                <span class="mobile-menu-icon" style="color: #000;">
                                    <span style="background: #000;"></span>
                                    <span style="background: #000;"></span>
                                    <span style="background: #000;"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* ============================================
       HEADER MAIN LAYOUT
       ============================================ */
    .header-main {
        display: flex;
        align-items: center;
        gap: 15px;
        width: 100%;
    }
    
    .header-left {
        flex-shrink: 0;
    }
    
    .mean__menu-wrapper {
        flex-shrink: 0;
    }
    
    .header-right {
        flex-shrink: 0;
        gap: 10px;
    }
    
    /* ============================================
       HEADER SEARCH FORM - DESKTOP
       ============================================ */
    .header-search {
        flex: 1;
        max-width: 550px;
        margin: 0 15px;
        min-width: 0;
    }
    
    .header-search-form {
        display: flex;
        align-items: stretch;
        width: 100%;
        gap: 0;
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        overflow: visible;
        transition: box-shadow 0.3s ease;
        position: relative;
        z-index: 100;
    }
    
    .header-search {
        position: relative;
        z-index: 100;
    }
    
    .mega-menu-wrapper {
        position: relative;
        z-index: 1;
    }
    
    .header-search-form:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }
    
    .header-search-form .search-input-wrapper {
        flex: 1;
        min-width: 0;
    }
    
    .header-search-form .search-input {
        border: none;
        border-radius: 30px 0 0 30px;
        padding: 10px 20px;
        font-size: 0.9rem;
        height: 42px;
        background: transparent;
    }
    
    .header-search-form .search-input:focus {
        outline: none;
        box-shadow: none;
        background: #f8f9fa;
    }
    
    .header-search-form .search-input::placeholder {
        color: #999;
        font-size: 0.9rem;
    }
    
    .header-search-form .search-select {
        border: none;
        border-left: 1px solid #e0e0e0;
        border-right: 1px solid #e0e0e0;
        border-radius: 0;
        padding: 10px 35px 10px 15px;
        font-size: 0.85rem;
        height: 42px;
        max-width: 180px;
        min-width: 150px;
        background: #fff;
        cursor: pointer;
        appearance: auto !important;
        -webkit-appearance: menulist !important;
        -moz-appearance: menulist !important;
        z-index: 101;
        position: relative;
    }
    
    .header-search-form .search-select:focus {
        outline: none;
        box-shadow: none;
        background-color: #f8f9fa;
        z-index: 9999;
    }
    
    .header-search-form .search-select:active {
        z-index: 9999;
    }
    
    .header-search-form .search-select option {
        padding: 10px 15px;
        background: #fff;
        color: #333;
        font-size: 0.9rem;
        display: block;
    }
    
    /* Ensure dropdown is not clipped */
    .header-search-form {
        overflow: visible !important;
    }
    
    .header-search {
        overflow: visible !important;
    }
    
    .mega-menu-wrapper {
        overflow: visible !important;
    }
    
    .header-search-form .search-btn {
        border: none;
        border-radius: 0 30px 30px 0;
        padding: 0 20px;
        height: 42px;
        background: linear-gradient(135deg, #6F00FD, #0EA5E9);
        color: #fff;
        white-space: nowrap;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .header-search-form .search-btn:hover {
        background: linear-gradient(135deg, #5a00d4, #0c8fc7);
        transform: scale(1.02);
    }
    
    .header-search-form .search-btn:active {
        transform: scale(0.98);
    }
    
    /* Responsive Desktop Search */
    @media (max-width: 1400px) {
        .header-main {
            gap: 10px;
        }
        
        .header-search {
            max-width: 450px;
            margin: 0 10px;
        }
        
        .header-search-form .search-select {
            max-width: 160px;
            min-width: 130px;
            font-size: 0.8rem;
            padding: 10px 30px 10px 12px;
        }
    }
    
    @media (max-width: 1200px) {
        .header-main {
            gap: 8px;
        }
        
        .header-search {
            max-width: 380px;
            margin: 0 8px;
        }
        
        .header-search-form .search-select {
            max-width: 140px;
            min-width: 120px;
            font-size: 0.8rem;
            padding: 10px 28px 10px 10px;
        }
        
        .header-search-form .search-input {
            padding: 10px 15px;
            font-size: 0.85rem;
        }
        
        .header-search-form .search-btn {
            padding: 0 15px;
        }
    }
    
    @media (max-width: 991px) {
        .header-search {
            display: none !important;
        }
        
        .header-main {
            justify-content: space-between;
            flex-wrap: nowrap;
            width: 100%;
        }
        
        .header-left {
            flex-shrink: 0;
        }
        
        .header-left .logo img {
            max-height: 45px;
            width: auto;
        }
        
        .mean__menu-wrapper {
            display: none;
        }
        
        .header-right {
            gap: 8px;
            flex-wrap: nowrap;
            flex-shrink: 0;
        }
        
        .user-icon,
        .menu-cart button {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    
    /* Mobile Menu Button */
    .mobile-menu-btn {
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 5px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .mobile-menu-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .mobile-menu-btn:active {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .mobile-menu-icon {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 24px;
        height: 18px;
        position: relative;
    }
    
    .mobile-menu-icon span {
        display: block;
        width: 100%;
        height: 2px;
        background: #fff;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .mobile-menu-btn:hover .mobile-menu-icon span {
        background: #6F00FD;
    }
    
    /* Ensure sidebar toggle works */
    .sidebar__toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    /* Mobile responsive improvements */
    @media (max-width: 576px) {
        .header-main {
            gap: 5px;
        }
        
        .header-right {
            gap: 5px;
        }
        
        .header__hamburger {
            margin-left: 5px;
        }
        
        .mobile-menu-btn {
            width: 36px;
            height: 36px;
        }
        
        .mobile-menu-icon {
            width: 20px;
            height: 16px;
        }
        
        .mobile-menu-icon span {
            height: 2px;
        }
        
        /* User and cart icons smaller on mobile */
        .user-icon,
        .menu-cart button {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 480px) {
        .header-left .logo img {
            max-height: 40px;
        }
        
        .mobile-menu-btn {
            width: 32px;
            height: 32px;
        }
        
        .mobile-menu-icon {
            width: 18px;
            height: 14px;
        }
    }
    
    /* ============================================
       MOBILE SEARCH FORM IN SIDEBAR
       ============================================ */
    .mobile-search-form {
        padding: 0 20px;
        margin-bottom: 20px;
    }
    
    .mobile-search-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }
    
    .mobile-search-form form {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    
    .mobile-search-form .form-control,
    .mobile-search-form .form-select {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fff;
        width: 100%;
        appearance: auto;
        -webkit-appearance: menulist;
        -moz-appearance: menulist;
    }
    
    .mobile-search-form .mobile-kategori-select {
        z-index: 10;
        position: relative;
    }
    
    .mobile-search-form .mobile-kategori-select option {
        padding: 8px 12px;
        background: #fff;
        color: #333;
    }
    
    .mobile-search-form .form-control:focus,
    .mobile-search-form .form-select:focus {
        outline: none;
        border-color: #6F00FD;
        box-shadow: 0 0 0 3px rgba(111, 0, 253, 0.1);
    }
    
    .mobile-search-form .form-control::placeholder {
        color: #999;
    }
    
    .mobile-search-form .btn-primary {
        background: linear-gradient(135deg, #6F00FD, #0EA5E9);
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 12px;
    }
    
    .mobile-search-form .btn-primary:hover {
        background: linear-gradient(135deg, #5a00d4, #0c8fc7);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(111, 0, 253, 0.3);
    }
    
    .mobile-search-form .btn-primary:active {
        transform: translateY(0);
    }
    
    /* Tablet adjustments */
    @media (min-width: 768px) and (max-width: 991px) {
        .mobile-search-form {
            padding: 0 25px;
        }
    }
    
    /* Mobile responsive improvements */
    @media (max-width: 576px) {
        .mobile-search-form {
            padding: 0 15px;
            margin-bottom: 15px;
        }
        
        .mobile-search-title {
            font-size: 0.95rem;
            margin-bottom: 12px;
        }
        
        .mobile-search-form .form-control,
        .mobile-search-form .form-select {
            padding: 10px 12px;
            font-size: 0.9rem;
        }
        
        .mobile-search-form .btn-primary {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
    }
</style>
