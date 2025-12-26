<!DOCTYPE html>
<html lang="en">
<!--<< Header Area >>-->
@php
    $profil = \App\Models\Profil::first();
    $manageInfos = \App\Models\ManageInfo::where('status', 'aktif')->get();
    $ownerWhatsapp = \App\Models\OwnerWhatsapp::first();
@endphp
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="modinatheme">
    <meta name="description" content="{{ $profil->deskripsi_perusahaan }}">
    <!-- ======== Page title ============ -->
    <title>{{ $profil->nama_perusahaan }}</title>
    <!--<< Favcion >>-->
    @if($profil && $profil->logo_perusahaan)
        <link rel="shortcut icon" href="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('web') }}/assets/img/favicon.svg" type="image/x-icon">
    @endif
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/bootstrap.min.css">
    <!--<< Font Awesome.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/font-awesome.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/meanmenu.css">
    <!--<< Swiper Slider.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/nice-select.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/main.css">
    <!--<< Style.css >>-->
    <link rel="stylesheet" href="{{ asset('web') }}/assets/css/style.css">
    @yield('style')
</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner">
            </div>
            <div class="txt-loading">
                <span data-text-preloader="G" class="letters-loading">
                    G
                </span>
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                <span data-text-preloader="A" class="letters-loading">
                    A
                </span>
                <span data-text-preloader=" " class="letters-loading">
                     
                </span>
                <span data-text-preloader="P" class="letters-loading">
                    P
                </span>
                <span data-text-preloader="R" class="letters-loading">
                    R
                </span>
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                <span data-text-preloader="N" class="letters-loading">
                    N
                </span>
                <span data-text-preloader="T" class="letters-loading">
                    T
                </span>
               
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <!--<< Mouse Cursor Start >>-->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <!-- Back To Top Start -->
    {{-- <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div> --}}

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.html">
                                <img src="{{ asset('web') }}/assets/img/logo/logo.svg" alt="logo-img">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                  
                    <!-- Mobile Search Form -->
                    <div class="mobile-search-form">
                        <h5 class="mobile-search-title">Cari Produk</h5>
                        <form action="{{ route('shop') }}" method="GET">
                            <div class="mb-3">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Cari produk..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="mb-3">
                                <select name="kategori" class="form-select mobile-kategori-select">
                                    <option value="">Semua Kategori</option>
                                    @php
                                        $kategoris = \App\Models\ManageKategori::orderBy('nama_kategori')->get();
                                    @endphp
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Cari Produk
                            </button>
                        </form>
                    </div>
                  
                    <div class="mobile-menu fix mb-3"></div>
                 
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header Area Start -->
    @include('template_web.header')


    <!-- Sidebar Area Here -->
    @include('page_web.keranjang.keranjang')

    <!-- Search Area Start -->
    <div class="search-wrap">
        <div class="search-inner">
            <i class="fas fa-times search-close" id="search-close"></i>
            <div class="search-cell">
                <form method="get">
                    <div class="search-field-holder">
                        <input type="search" class="main-search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Popup Iklan -->
    {{-- @include('template_web.popup_iklan') --}}

	@yield('content')

 

    <!-- Footer Section Start -->
    @include('template_web.footer')

    <!-- WhatsApp Floating Button -->
    @if($ownerWhatsapp && $ownerWhatsapp->no_wa)
        @php
            $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
            $whatsapp_url = 'https://wa.me/' . $no_wa_clean;
            if($ownerWhatsapp->template_pesan) {
                $whatsapp_url .= '?text=' . urlencode($ownerWhatsapp->template_pesan);
            }
        @endphp
        <a href="{{ $whatsapp_url }}" target="_blank" class="whatsapp-float" title="Hubungi Kami via WhatsApp">
            <div class="whatsapp-float-icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <span class="whatsapp-float-pulse"></span>
        </a>
    @endif

    <!-- SweetAlert2 Alert -->
    @include('sweetalert::alert')

    @yield('script')
    <!--<< All JS Plugins >>-->
    <script src="{{ asset('web') }}/assets/js/jquery-3.7.1.min.js"></script>
    <!--<< Viewport Js >>-->
    <script src="{{ asset('web') }}/assets/js/viewport.jquery.js"></script>
    <!--<< Bootstrap Js >>-->
    <script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--<< Gsap Js >>-->
    <script src="{{ asset('web') }}/assets/js/gsap/gsap.js"></script>
    <!--<< Gsap Scroll To Pluging Js >>-->
    <script src="{{ asset('web') }}/assets/js/gsap/gsap-scroll-to-plugin.js"></script>
    <!--<< Gsap Scroll Smoother Js >>-->
    <script src="{{ asset('web') }}/assets/js/gsap/gsap-scroll-smoother.js"></script>
    <!--<< Gsap Scroll Trigger Js >>-->
    <script src="{{ asset('web') }}/assets/js/gsap/gsap-scroll-trigger.js"></script>
    <!--<< Gsap Split Text Js >>-->
    <script src="{{ asset('web') }}/assets/js/gsap/gsap-split-text.js"></script>
    <!--<< Nice Select Js >>-->
    <script src="{{ asset('web') }}/assets/js/jquery.nice-select.min.js"></script>
    <!--<< Waypoints Js >>-->
    <script src="{{ asset('web') }}/assets/js/jquery.waypoints.js"></script>
    <!--<< Counterup Js >>-->
    <script src="{{ asset('web') }}/assets/js/jquery.counterup.min.js"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="{{ asset('web') }}/assets/js/swiper-bundle.min.js"></script>
    <!--<< MeanMenu Js >>-->
    <script src="{{ asset('web') }}/assets/js/jquery.meanmenu.min.js"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="{{ asset('web') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <!--<< Wow Animation Js >>-->
    <script src="{{ asset('web') }}/assets/js/wow.min.js"></script>
    <!--<< Main.js >>-->
    <script src="{{ asset('web') }}/assets/js/main.js"></script>
    <!--<< SweetAlert2 JS >>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- WhatsApp Float Button Styles -->
    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20BA5A;
            transform: scale(1.1);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .whatsapp-float-icon {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .whatsapp-float-pulse {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #25D366;
            opacity: 0.6;
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
            z-index: 1;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes ping {
            75%, 100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                width: 55px;
                height: 55px;
                bottom: 15px;
                right: 15px;
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 10px;
                right: 10px;
                font-size: 24px;
            }
        }
    </style>
</body>

</html>
