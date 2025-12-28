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
            @if (
                $profil->facebook_perusahaan ||
                    $profil->twitter_perusahaan ||
                    $profil->instagram_perusahaan ||
                    $profil->linkedin_perusahaan)
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
                            <a href="{{ $profil->linkedin_perusahaan }}"><i class="fab fa-tiktok"></i></a>
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
                                <input type="text" name="search" class="form-control search-input"
                                    placeholder="Cari produk..." value="{{ request('search') }}">
                            </div>
                            <select name="kategori" class="form-select search-select" id="headerKategoriSelect">
                                <option value="">Semua Kategori</option>
                                @if (isset($kategoris) && $kategoris && $kategoris->count() > 0)
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
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
                    <!-- Search Form - Mobile -->
                    <div class="header-search-mobile d-lg-none w-100">
                        <div class="accordion" id="mobileSearchAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingMobileSearch">
                                    <button class="accordion-button collapsed mobile-accordion-btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseMobileSearch" aria-expanded="false"
                                        aria-controls="collapseMobileSearch">
                                        <i class="fas fa-search accordion-icon"></i>
                                        <span class="accordion-text">Cari Produk & Kategori</span>
                                        <i class="fas fa-chevron-down accordion-arrow"></i>
                                    </button>
                                </h2>
                                <div id="collapseMobileSearch" class="accordion-collapse collapse"
                                    aria-labelledby="headingMobileSearch" data-bs-parent="#mobileSearchAccordion">
                                    <div class="accordion-body">
                                        <div class="mobile-search-container">
                                            <!-- Search Bar -->
                                            <form action="{{ route('shop') }}" method="GET"
                                                class="mobile-search-form">
                                                <div class="mobile-search-wrapper">
                                                    <input type="hidden" name="kategori" id="hiddenKategori"
                                                        value="{{ request('kategori') }}">
                                                    <div class="mobile-search-input-container">
                                                        <i class="fas fa-search mobile-search-icon"></i>
                                                        <input type="text" name="search" class="mobile-search-input"
                                                            placeholder="Cari produk yang kamu inginkan..."
                                                            value="{{ request('search') }}" autocomplete="off">
                                                        <button type="submit" class="mobile-search-submit">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Kategori Dropdown -->
                                            <div class="mobile-kategori-wrapper mt-2">
                                                <select name="kategori" class="mobile-kategori-select"
                                                    id="mobileKategoriSelect">
                                                    <option value="">Semua Kategori</option>
                                                    @if (isset($kategoris) && $kategoris && $kategoris->count() > 0)
                                                        @foreach ($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}"
                                                                {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                                                {{ $kategori->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="" disabled>Belum ada kategori</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                                    // Handle mobile accordion button ripple effect
                                    const mobileAccordionBtn = document.querySelector('.mobile-accordion-btn');
                                    if (mobileAccordionBtn) {
                                        mobileAccordionBtn.addEventListener('click', function(e) {
                                            // Create ripple effect
                                            const ripple = document.createElement('div');
                                            const rect = this.getBoundingClientRect();
                                            const size = Math.max(rect.width, rect.height);
                                            const x = e.clientX - rect.left - size / 2;
                                            const y = e.clientY - rect.top - size / 2;

                                            ripple.style.width = ripple.style.height = size + 'px';
                                            ripple.style.left = x + 'px';
                                            ripple.style.top = y + 'px';
                                            ripple.className = 'accordion-ripple';

                                            this.appendChild(ripple);

                                            setTimeout(() => {
                                                ripple.remove();
                                            }, 600);
                                        });
                                    }

                                    // Handle mobile kategori dropdown
                                    const mobileKategoriSelect = document.getElementById('mobileKategoriSelect');
                                    const hiddenKategori = document.getElementById('hiddenKategori');

                                    if (mobileKategoriSelect && hiddenKategori) {
                                        // Set initial value
                                        hiddenKategori.value = mobileKategoriSelect.value;

                                        // Update hidden input when kategori changes
                                        mobileKategoriSelect.addEventListener('change', function() {
                                            hiddenKategori.value = this.value;
                                        });
                                    }

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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
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
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
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
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px 0;
        }

        .header-left {
            flex-shrink: 0;
            width: auto;
        }

        .header-left .logo img {
            max-height: 45px;
            width: auto;
        }

        .mean__menu-wrapper {
            display: none;
        }

        .header-search-mobile {
            display: flex !important;
            width: 100%;
            order: 3;
            margin-top: 10px;
        }

        .header-search-mobile-form {
            width: 100%;
        }

        .header-right {
            gap: 8px;
            flex-shrink: 0;
            order: 2;
            margin-left: auto;
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

    /* Tablet responsive improvements */
    @media (max-width: 991px) and (min-width: 577px) {
        .header-main {
            gap: 8px;
            padding: 8px 0;
        }

        .header-search-mobile {
            margin: 10px 0 8px 0;
        }

        .mobile-accordion-btn {
            padding: 16px 20px !important;
            border-radius: 16px !important;
            min-height: 56px !important;
        }

        .accordion-text {
            font-size: 0.95rem;
            margin: 0 12px;
        }

        .accordion-icon {
            font-size: 1rem;
        }

        .accordion-arrow {
            font-size: 0.9rem;
        }

        .accordion-body {
            padding: 16px 0 8px 0 !important;
        }

        .mobile-search-container {
            gap: 16px;
        }

        .mobile-kategori-select {
            padding: 12px 16px;
            font-size: 0.9rem;
            border-radius: 16px;
        }

        .mobile-search-input-container {
            border-radius: 25px;
        }

        .mobile-search-icon {
            left: 20px;
            font-size: 1rem;
        }

        .mobile-search-input {
            padding: 14px 50px 14px 50px;
            font-size: 0.95rem;
        }

        .mobile-search-submit {
            width: 40px;
            height: 40px;
            border-radius: 20px;
        }

        .header-right {
            gap: 6px;
        }

        .user-icon,
        .menu-cart button {
            width: 36px;
            height: 36px;
        }
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

        /* Mobile search accordion responsive */
        .header-search-mobile {
            margin: 8px 0 6px 0;
        }

        .mobile-accordion-btn {
            padding: 14px 16px !important;
            border-radius: 14px !important;
            min-height: 52px !important;
        }

        .accordion-text {
            font-size: 0.9rem;
            margin: 0 10px;
        }

        .accordion-icon {
            font-size: 0.9rem;
        }

        .accordion-arrow {
            font-size: 0.8rem;
        }

        .accordion-body {
            padding: 14px 0 8px 0 !important;
        }

        .mobile-search-container {
            gap: 12px;
        }

        .mobile-kategori-select {
            padding: 10px 14px;
            font-size: 0.85rem;
            border-radius: 14px;
        }

        .mobile-search-input-container {
            border-radius: 22px;
        }

        .mobile-search-icon {
            left: 18px;
            font-size: 0.9rem;
        }

        .mobile-search-input {
            padding: 12px 45px 12px 45px;
            font-size: 0.9rem;
        }

        .mobile-search-submit {
            width: 36px;
            height: 36px;
            border-radius: 18px;
        }

        /* User and cart icons smaller on mobile */
        .user-icon,
        .menu-cart button {
            width: 34px;
            height: 34px;
            font-size: 0.85rem;
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

        /* Extra small mobile accordion */
        .mobile-accordion-btn {
            padding: 12px 14px !important;
            border-radius: 12px !important;
            min-height: 48px !important;
        }

        .accordion-text {
            font-size: 0.85rem;
            margin: 0 8px;
        }

        .accordion-icon {
            font-size: 0.85rem;
        }

        .accordion-arrow {
            font-size: 0.75rem;
        }

        .accordion-body {
            padding: 12px 0 6px 0 !important;
        }

        .mobile-search-container {
            gap: 10px;
        }
    }

    /* ============================================
       MOBILE SEARCH CREATIVE STYLING
       ============================================ */
    .header-search-mobile {
        display: none;
        margin-top: 12px;
        animation: slideDownFade 0.4s ease-out;
    }

    @keyframes slideDownFade {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================
       MOBILE ACCORDION BUTTON FULL WIDTH
       ============================================ */

    /* Override Bootstrap accordion button for full width */
    .mobile-accordion-btn {
        width: 100% !important;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 50%, #f8f9fa 100%) !important;
        border: 2px solid #f0f0f0 !important;
        border-radius: 16px !important;
        padding: 16px 20px !important;
        font-weight: 600 !important;
        color: #495057 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        min-height: 56px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: relative !important;
        text-align: left !important;
    }

    .mobile-accordion-btn:focus {
        box-shadow: 0 0 0 3px rgba(111, 0, 253, 0.1), 0 2px 8px rgba(0, 0, 0, 0.06) !important;
        border-color: #6F00FD !important;
        outline: none !important;
    }

    .mobile-accordion-btn:not(.collapsed) {
        background: linear-gradient(135deg, #6F00FD 0%, #0EA5E9 100%) !important;
        color: #fff !important;
        border-color: #6F00FD !important;
        box-shadow: 0 4px 16px rgba(111, 0, 253, 0.2) !important;
    }

    .mobile-accordion-btn:hover:not(:disabled) {
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }

    .mobile-accordion-btn:not(.collapsed):hover:not(:disabled) {
        background: linear-gradient(135deg, #5a00d4 0%, #0c8fc7 100%) !important;
        box-shadow: 0 6px 20px rgba(111, 0, 253, 0.3) !important;
        transform: translateY(-1px) scale(1.002) !important;
    }

    .mobile-accordion-btn:active {
        transform: translateY(0) scale(0.998) !important;
    }

    .accordion-text {
        flex: 1;
        text-align: center;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0 12px;
    }

    .accordion-icon {
        color: #6F00FD;
        font-size: 1rem;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .mobile-accordion-btn:not(.collapsed) .accordion-icon {
        color: #fff;
        transform: scale(1.1);
    }

    .accordion-arrow {
        color: #6c757d;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex-shrink: 0;
    }

    .mobile-accordion-btn:not(.collapsed) .accordion-arrow {
        color: #fff;
        transform: rotate(180deg);
    }

    /* Accordion Content Styling */
    .accordion-collapse {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .accordion-body {
        padding: 16px 0 8px 0 !important;
        border: none !important;
        background: transparent !important;
    }

    /* Remove default Bootstrap accordion styles */
    .accordion-button::before,
    .accordion-button::after {
        display: none !important;
    }

    .accordion-item {
        border: none !important;
        background: transparent !important;
    }

    .accordion-header {
        margin-bottom: 0 !important;
    }

    /* Ripple effect for accordion button */
    .accordion-ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: accordionRipple 0.6s linear;
        pointer-events: none;
        z-index: 1;
    }

    @keyframes accordionRipple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .mobile-search-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
    }

    /* Kategori Dropdown Styling */
    .mobile-kategori-wrapper {
        width: 100%;
        position: relative;
    }

    .mobile-kategori-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #f0f0f0;
        border-radius: 16px;
        background: linear-gradient(135deg, #fff 0%, #f8f9ff 100%);
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 14 14'%3E%3Cpath fill='%236F00FD' d='M7 10L2 5h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        background-size: 14px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .mobile-kategori-select:hover {
        border-color: #6F00FD;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(111, 0, 253, 0.15);
    }

    .mobile-kategori-select:focus {
        outline: none;
        border-color: #6F00FD;
        box-shadow: 0 0 0 3px rgba(111, 0, 253, 0.1), 0 4px 12px rgba(111, 0, 253, 0.15);
        background: #fff;
    }

    .mobile-kategori-select option {
        padding: 12px;
        background: #fff;
        color: #333;
        font-size: 0.9rem;
    }

    /* Search Form Styling */
    .mobile-search-form {
        width: 100%;
    }

    .mobile-search-wrapper {
        position: relative;
        width: 100%;
    }

    .mobile-search-input-container {
        position: relative;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #fff 0%, #f8f9ff 50%, #fff 100%);
        border: 2px solid #f0f0f0;
        border-radius: 25px;
        padding: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06), inset 0 1px 2px rgba(255, 255, 255, 0.8);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .mobile-search-input-container:hover {
        border-color: #6F00FD;
        box-shadow: 0 4px 16px rgba(111, 0, 253, 0.12);
        transform: translateY(-1px);
    }

    .mobile-search-input-container:focus-within {
        border-color: #6F00FD;
        box-shadow: 0 0 0 3px rgba(111, 0, 253, 0.1), 0 6px 20px rgba(111, 0, 253, 0.15);
        background: #fff;
    }

    .mobile-search-icon {
        position: absolute;
        left: 20px;
        color: #6F00FD;
        font-size: 1rem;
        z-index: 2;
        pointer-events: none;
    }

    .mobile-search-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 14px 50px 14px 50px;
        font-size: 0.95rem;
        font-weight: 400;
        color: #333;
        outline: none;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .mobile-search-input::placeholder {
        color: #999;
        font-weight: 400;
        opacity: 0.8;
    }

    .mobile-search-input:focus {
        color: #6F00FD;
    }

    .mobile-search-input:focus~.mobile-search-submit {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        transform: scale(1.1);
        box-shadow: 0 4px 16px rgba(76, 175, 80, 0.4);
    }

    .mobile-search-submit {
        background: linear-gradient(135deg, #6F00FD 0%, #0EA5E9 100%);
        border: none;
        border-radius: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(111, 0, 253, 0.2);
        position: relative;
        z-index: 2;
    }

    .mobile-search-submit:hover {
        background: linear-gradient(135deg, #5a00d4 0%, #0c8fc7 100%);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(111, 0, 253, 0.3);
    }

    .mobile-search-submit:active {
        transform: scale(0.95);
    }

    /* ============================================
       MOBILE MENU BUTTON
       ============================================ */
</style>
