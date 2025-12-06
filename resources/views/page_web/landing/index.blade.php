@extends('template_web.layout')

@section('content')
@php
    $profil = \App\Models\Profil::first();
    $manageInfos = \App\Models\ManageInfo::where('status', 'aktif')->get();
    $ownerWhatsapp = \App\Models\OwnerWhatsapp::first();
@endphp

{{-- Popup Iklan Modal --}}
@if($manageInfos && $manageInfos->count() > 0)
    <div class="modal fade popup-iklan-modal" id="popupIklan" tabindex="-1" aria-labelledby="popupIklanLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content popup-iklan-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div id="popupIklanCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach($manageInfos as $index => $info)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="popup-iklan-slide" 
                                         @if($info->gambar)
                                         style="background-image: url('{{ asset('info/gambar/' . $info->gambar) }}');"
                                         @endif>
                                        <div class="popup-iklan-overlay">
                                            <div class="popup-iklan-content-inner">
                                                <h5 class="popup-iklan-title">{{ $info->judul }}</h5>
                                                @if($info->deskripsi)
                                                    <div class="popup-iklan-description">
                                                        <p class="mb-0">{!! nl2br(e($info->deskripsi)) !!}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($manageInfos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#popupIklanCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sebelumnya</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#popupIklanCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Selanjutnya</span>
                            </button>
                            <div class="carousel-indicators">
                                @foreach($manageInfos as $index => $info)
                                    <button type="button" data-bs-target="#popupIklanCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Hero Section --}}
<section class="hero-section-3">
    <div class="swiper-dot-2">
        <div class="dots"></div>
    </div>
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero-3">
                    <div class="hero-bg bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/hero/hero-bg-1.jpg');"></div>
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6>{{ $beranda->judul_utama }}</h6>
                                    <h1>{{ $beranda->slogan }}</h1>
                                    <p>{{ $beranda->keterangan }}</p>
                                </div>
                                <div class="hero-button">
                                    <a href="{{ route('shop') }}" class="theme-btn">Belanja Sekarang</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="hero-image">
                                    <img src="{{ asset('upload/beranda/' . $beranda->gambar_utama) }}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero-3">
                    <div class="hero-bg bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/hero/hero-bg-2.jpg');"></div>
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6>{{ $beranda->judul_sekunder }}</h6>
                                    <h1>{{ $beranda->slogan }}</h1>
                                    <p>{{ $beranda->keterangan }}</p>
                                </div>
                                <div class="hero-button">
                                    <a href="{{ route('shop') }}" class="theme-btn">Belanja Sekarang</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="hero-image">
                                    <img src="{{ asset('upload/beranda/' . $beranda->gambar_sekunder) }}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero-3">
                    <div class="hero-bg bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/hero/hero-bg-1.jpg');"></div>
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6>{{ $beranda->judul_utama }}</h6>
                                    <h1>{{ $beranda->slogan }}</h1>
                                    <p>{{ $beranda->keterangan }}</p>
                                </div>
                                <div class="hero-button">
                                    <a href="{{ route('shop') }}" class="theme-btn">Belanja Sekarang</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="hero-image">
                                    <img src="{{ asset('upload/beranda/' . $beranda->gambar_utama) }}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Shop Category Section --}}
<section class="shop-catagories-section-3 fix section-padding">
    <div class="container">
        <div class="swiper catagory-product-slider">
            <div class="swiper-wrapper">
                @forelse($produkTerbaru as $produk)
                    <div class="swiper-slide">
                        <a href="{{ route('shop.detail', $produk->slug) }}" class="product-card-link">
                            <div class="shop-catagories-item position-relative product-card-clickable">
                                <div class="thumb d-flex justify-content-center align-items-center" style="position:relative;">
                                    @php
                                        $gambar = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0
                                            ? asset('produk/gambar/' . $produk->gambar_produk[0])
                                            : asset('web/assets/img/catagories/10.png');
                                    @endphp
                                    <img src="{{ $gambar }}" alt="{{ $produk->judul }}" style="width:90px; height:90px; object-fit:cover; border-radius:8px;">
                                    @if(isset($sectionTerbaru) && $sectionTerbaru->is_new == 1)
                                        <span class="badge bg-danger position-absolute" style="top:6px; left:6px; z-index:2; font-size: 0.8rem;">NEW</span>
                                    @endif
                                </div>
                                <div class="content">
                                    <h3>{{ $produk->judul }}</h3>
                                    <p>
                                        @if ($produk->diskon > 0)
                                            <span class="text-decoration-line-through text-muted me-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            <span class="text-primary fw-bold">Rp {{ number_format($produk->harga - ($produk->harga * $produk->diskon) / 100, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-primary fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="shop-catagories-item">
                            <div class="thumb d-flex justify-content-center align-items-center" style="position:relative;">
                                <img src="{{ asset('web') }}/assets/img/catagories/10.png" alt="img" style="width:90px; height:90px; object-fit:cover; border-radius:8px;">
                                <span class="badge bg-danger position-absolute" style="top:6px; left:6px; z-index:2; font-size: 0.8rem;">NEW</span>
                            </div>
                            <div class="content">
                                <h3><a href="{{ route('shop') }}">Produk Terbaru</a></h3>
                                <p>Belum ada produk</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- About Section --}}
<section class="about-section section-padding">
    <div class="container">
        <div class="about-wrapper">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <div class="sub-title wow fadeInUp">
                                <span>Tentang Kami</span>
                            </div>
                            <h2 class="split-text right">
                                @if (isset($profil) && $profil->nama_perusahaan)
                                    {{ $profil->nama_perusahaan }}
                                @else
                                    Layanan Percetakan Profesional
                                @endif
                            </h2>
                        </div>
                        <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            @if (isset($profil) && $profil->alamat_perusahaan)
                                {{ $profil->alamat_perusahaan }}
                            @else
                                Kami menghadirkan solusi percetakan yang praktis dan hasil terbaik untuk kebutuhan Anda. Dengan pengalaman bertahun-tahun, kami siap membantu mewujudkan produk cetak impian Anda.
                            @endif
                        </p>
                        <div class="icon-box-items">
                            <div class="icon-items wow fadeInUp" data-wow-delay=".3s">
                                <div class="icons">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="59" height="59" viewBox="0 0 59 59" fill="none">
                                        <g clip-path="url(#clip0_20_345)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2108 36.0912H32.7077C33.2219 36.0912 33.6392 35.6739 33.6392 35.1597C33.6392 34.6455 33.2219 34.2281 32.7077 34.2281H20.2108C19.6966 34.2281 19.2793 34.6455 19.2793 35.1597C19.2793 35.6739 19.6965 36.0912 20.2108 36.0912Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.0752 35.1596V57.5876C28.0752 58.1019 28.4925 58.5191 29.0067 58.5191C29.5203 58.5191 29.9383 58.1018 29.9383 57.5876V35.1596C29.9383 34.6453 29.5203 34.228 29.0067 34.228C28.4925 34.228 28.0752 34.6454 28.0752 35.1596Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.12479 0.480682C4.49911 0.480682 1.55469 3.42511 1.55469 7.05137C1.55469 10.6776 4.49911 13.6215 8.12479 13.6215C11.7512 13.6215 14.6956 10.6777 14.6956 7.05137C14.6956 3.42501 11.7512 0.480682 8.12479 0.480682ZM8.12479 2.34384C10.7233 2.34384 12.8324 4.45298 12.8324 7.05137C12.8324 9.64927 10.7233 11.7583 8.12479 11.7583C5.52689 11.7583 3.41785 9.64927 3.41785 7.05137C3.41785 4.45289 5.52699 2.34384 8.12479 2.34384Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M50.8745 0.480682C47.2481 0.480682 44.3037 3.42511 44.3037 7.05137C44.3037 10.6776 47.2481 13.6215 50.8745 13.6215C54.5002 13.6215 57.4446 10.6777 57.4446 7.05137C57.4446 3.42501 54.5002 0.480682 50.8745 0.480682ZM50.8745 2.34384C53.4724 2.34384 55.5814 4.45298 55.5814 7.05137C55.5814 9.64927 53.4724 11.7583 50.8745 11.7583C48.276 11.7583 46.1669 9.64927 46.1669 7.05137C46.1669 4.45289 48.276 2.34384 50.8745 2.34384Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2601 26.989C13.4142 27.2996 13.7334 27.5063 14.0942 27.5063L14.4402 27.4392L23.0181 24.0104C24.3384 23.4832 25.8383 24.126 26.3662 25.4463C26.8935 26.7661 26.2501 28.2659 24.9304 28.7938L13.6018 33.3218C12.5193 33.7547 11.2933 33.4044 10.5996 32.4952C10.3574 32.1778 9.93937 32.0499 9.56061 32.1778C9.18242 32.3057 8.92777 32.661 8.92777 33.0604V37.7388C8.92777 38.212 9.28237 38.6095 9.75194 38.6642L17.2922 39.5349C19.074 39.7405 20.4191 41.2496 20.4191 43.0439V57.5877C20.4191 58.102 20.8365 58.5192 21.3507 58.5192C21.865 58.5192 22.2822 58.1019 22.2822 57.5877V43.0439C22.2822 40.3032 20.2278 37.9984 17.5057 37.6842L10.7908 36.9085V34.9634C11.8653 35.4571 13.1273 35.518 14.293 35.0522L25.6222 30.5241C27.8965 29.6143 29.0052 27.0295 28.0959 24.7545C27.1867 22.4796 24.6019 21.371 22.327 22.2803L14.4793 25.4172L9.97113 18.0385C9.33459 16.9964 8.29678 16.2629 7.1025 16.0101C7.06587 16.0027 7.02924 15.9946 6.99193 15.9871C5.74048 15.7225 4.43563 16.0107 3.41214 16.7777C2.38864 17.5453 1.74586 18.7166 1.64893 19.9922C1.10114 27.2002 0.00253292 41.6459 0.00253292 41.6459C0.00058452 41.6695 0 41.693 0 41.7167C0 44.4543 2.05011 46.7571 4.76842 47.0751L11.4913 47.9433V57.5876C11.4913 58.1019 11.9086 58.5191 12.4228 58.5191C12.937 58.5191 13.3543 58.1018 13.3543 57.5876V47.1242C13.3543 46.6553 13.0065 46.2603 12.542 46.2001L4.98995 45.2257C3.22061 45.0214 1.88215 43.532 1.86296 41.7546C1.86296 41.7496 3.50624 20.1333 3.50624 20.1333C3.56275 19.3936 3.93538 18.7136 4.52915 18.2689C5.12351 17.8236 5.87998 17.6565 6.60654 17.8099L6.71643 17.8329C7.40957 17.9795 8.01134 18.4056 8.38085 19.0099C9.79003 21.3165 12.6462 25.9918 13.2033 26.9041C13.2222 26.9338 13.2408 26.9624 13.2601 26.989Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.86418 28.3442L8.8577 33.2449C9.98612 35.0918 12.2828 35.8557 14.2932 35.0521C14.7707 34.8615 15.0036 34.3186 14.8124 33.8417C14.6218 33.3641 14.0789 33.1312 13.602 33.3218C12.4356 33.7883 11.1028 33.3454 10.4476 32.2735L7.45417 27.3728C7.18588 26.9343 6.61198 26.7959 6.17359 27.0635C5.735 27.3319 5.59589 27.9057 5.86418 28.3442Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M43.6591 26.8288L34.6389 28.1044C32.2131 28.4473 30.5226 30.6954 30.8655 33.1213C31.2083 35.5464 33.4564 37.2376 35.8823 36.8947L46.9762 35.3253C47.4079 35.2644 47.8227 35.1415 48.2096 34.9632V36.9083L41.4948 37.6839C38.7726 37.9982 36.7183 40.3029 36.7183 43.0436V57.5874C36.7183 58.1017 37.1356 58.519 37.6498 58.519C38.164 58.519 38.5813 58.1016 38.5813 57.5874V43.0436C38.5813 41.2494 39.9265 39.7402 41.7083 39.5346L49.246 38.6639H49.2441C49.7106 38.6129 50.0726 38.218 50.0726 37.7385V33.0595C50.0726 32.6602 49.8179 32.3056 49.4397 32.1777C49.0616 32.0491 48.6435 32.1771 48.4008 32.4944C47.9928 33.0285 47.3885 33.3856 46.7152 33.4807L35.6213 35.0494C34.2134 35.2487 32.9091 34.2675 32.7104 32.8596C32.5111 31.4523 33.4923 30.1481 34.8996 29.9487L44.3527 28.6122L44.2248 28.6209L45.0197 28.175L50.0601 19.9243C50.7047 18.8697 51.8854 18.2642 53.1182 18.3574C53.1357 18.3586 53.1524 18.3598 53.1698 18.3611C54.8305 18.4865 56.1365 19.8317 56.2123 21.4949L57.137 41.7362C57.1271 43.5212 55.7856 45.0198 54.01 45.2253L46.6152 46.0793C46.15 46.1327 45.7972 46.5233 45.791 46.9916L45.6456 57.5744C45.6388 58.0887 46.0505 58.5116 46.5642 58.519C47.0785 58.5258 47.5014 58.1141 47.5088 57.5998L47.6423 47.8356L54.2237 47.076C56.9458 46.7617 59.0002 44.4564 59.0002 41.7164C59.0002 41.702 58.9996 41.6878 58.9989 41.6735C58.9989 41.6735 58.3815 28.1569 58.0735 21.4098C57.9543 18.8051 55.9098 16.6992 53.3101 16.5035C53.2926 16.5022 53.2753 16.5003 53.2585 16.4991C51.3283 16.3537 49.4794 17.3014 48.4702 18.9529L43.6591 26.8288Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M38.3001 3.27537C38.3001 2.53449 38.0057 1.82333 37.4816 1.29921C36.9574 0.774988 36.247 0.480682 35.5055 0.480682H22.5087C20.9647 0.480682 19.7139 1.73214 19.7139 3.27537V15.1151C19.7139 15.7237 20.0691 16.2765 20.6231 16.5286C21.177 16.7807 21.8273 16.6857 22.2862 16.2857C23.1824 15.5051 24.4451 14.4045 25.1486 13.791C25.3188 13.6432 25.5362 13.5619 25.761 13.5619H35.5054C36.2469 13.5619 36.9574 13.2675 37.4815 12.7433C38.0056 12.2191 38.3001 11.508 38.3001 10.7672V3.27537H38.3001ZM21.577 14.4326V3.27537C21.577 2.76119 21.9938 2.34384 22.5086 2.34384H35.5054C35.7525 2.34384 35.9897 2.44194 36.1643 2.6171C36.3388 2.79158 36.437 3.02822 36.437 3.27537V10.7672C36.437 11.0143 36.3389 11.251 36.1643 11.4254C35.9898 11.6006 35.7525 11.6987 35.5054 11.6987H25.7611C25.086 11.6987 24.434 11.9427 23.9247 12.3862L21.577 14.4326Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.8563 6.25146H33.2977C33.812 6.25146 34.2292 5.83411 34.2292 5.31993C34.2292 4.80574 33.8119 4.3884 33.2977 4.3884H24.8563C24.3422 4.3884 23.9248 4.80574 23.9248 5.31993C23.9248 5.83411 24.3421 6.25146 24.8563 6.25146Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.8563 9.64867H29.0068C29.5204 9.64867 29.9383 9.23133 29.9383 8.71714C29.9383 8.20286 29.5204 7.78561 29.0068 7.78561H24.8563C24.3422 7.78561 23.9248 8.20296 23.9248 8.71714C23.9247 9.23133 24.3421 9.64867 24.8563 9.64867Z" fill="#6F00FD" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M44.1769 35.7217L46.976 35.3255C48.2895 35.1398 49.4509 34.3765 50.1427 33.245L53.1362 28.3443C53.4045 27.9058 53.2653 27.332 52.8269 27.0637C52.3884 26.796 51.8146 26.9345 51.5463 27.373L48.5528 32.2737C48.1517 32.9301 47.4771 33.373 46.7151 33.481L43.916 33.8767C43.4067 33.9488 43.0515 34.4208 43.1235 34.93C43.1956 35.4385 43.6676 35.7937 44.1769 35.7217Z" fill="#6F00FD" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_20_345">
                                                <rect width="59" height="59" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="content">
                                    <h4>Konsultasi Gratis</h4>
                                    <p>Dapatkan konsultasi gratis untuk kebutuhan percetakan Anda. Tim kami siap membantu memberikan solusi terbaik.</p>
                                </div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="pro-items wow fadeInUp" data-wow-delay=".3s">
                                <div class="pro-head">
                                    <h6 class="title">Kepuasan Pelanggan</h6>
                                    <span class="point">95%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value" style="width: 95%;"></div>
                                </div>
                            </div>
                            <div class="pro-items wow fadeInUp" data-wow-delay=".5s">
                                <div class="pro-head">
                                    <h6 class="title">Kualitas Terpercaya</h6>
                                    <span class="point">90%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-value style-two" style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="about-author">
                            @if (isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                @php
                                    $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                @endphp
                                <a href="https://wa.me/{{ $no_wa_clean }}" target="_blank" class="theme-btn wow fadeInUp" data-wow-delay=".3s" style="background-color:#25D366; border: none; color:#fff;">
                                    <i class="fab fa-whatsapp"></i> Hubungi Kami
                                </a>
                            @else
                                <a href="{{ route('about') }}" class="theme-btn wow fadeInUp" data-wow-delay=".3s">LEBIH LANJUT</a>
                            @endif
                            <div class="author-image wow fadeInUp d-flex align-items-center gap-3" data-wow-delay=".5s">
                                <div class="author-logo" style="width:54px; height:54px; overflow:hidden; border-radius:50%; flex-shrink:0; border: 1.5px solid #eee; background: #fff;">
                                    @if (isset($profil) && $profil->logo_perusahaan)
                                        <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="{{ $profil->nama_perusahaan ?? 'Logo' }}" style="width: 100%; height: 100%; object-fit: contain; display:block;">
                                    @else
                                        @php
                                            $logoDefault = asset('env/logo.png');
                                        @endphp
                                        <img src="{{ $logoDefault }}" alt="author-img" style="width: 100%; height: 100%; object-fit: contain; display:block;">
                                    @endif
                                </div>
                                <div class="content ps-1">
                                    <span class="mb-2" style="display: block; font-size: 0.95em;">Hubungi Ahli Kami</span>
                                    @if (isset($profil) && isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                        <h4 style="font-size:1.2em; margin:0;">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa) }}" target="_blank">{{ $ownerWhatsapp->no_wa }}</a>
                                        </h4>
                                    @elseif(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                        <h4 style="font-size:1.2em; margin:0;">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa) }}" target="_blank">{{ $ownerWhatsapp->no_wa }}</a>
                                        </h4>
                                    @else
                                        <h4 style="font-size:1.2em; margin:0;"><a href="#">Hubungi Kami</a></h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-new-items">
                        @if (isset($profil) && $profil->latitude && $profil->longitude)
                            <div id="map" style="height: 500px; width: 100%; border-radius: 10px;"></div>
                        @else
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="thumb-image-1">
                                        @if (isset($profil) && $profil->gambar)
                                            <img src="{{ asset('profil/gambar/' . $profil->gambar) }}" alt="{{ $profil->nama_perusahaan ?? 'img' }}">
                                        @else
                                            <img src="{{ asset('web') }}/assets/img/about/about-1.jpg" alt="img">
                                        @endif
                                    </div>
                                    <div class="thumb-image-1 style-2">
                                        <img src="{{ asset('web') }}/assets/img/about/about-2.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="thumb-image-1 style-3">
                                        <img src="{{ asset('web') }}/assets/img/about/about-3.jpg" alt="img">
                                    </div>
                                    <div class="thumb-image-1 style-4">
                                        <img src="{{ asset('web') }}/assets/img/about/about-4.jpg" alt="img">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Service Section --}}
<section class="service-section fix section-padding pt-0">
    <div class="container">
        <div class="section-title text-center">
            <div class="sub-title wow fadeInUp">
                <span>Layanan Kami</span>
            </div>
            <h2 class="split-text right">Layanan Kami <br> dan Berkualitas</h2>
        </div>
        <div class="service-wrapper">
            <div class="swiper service-slider">
                <div class="swiper-wrapper">
                    @foreach ($manageLayanans as $manageLayanan)
                        <div class="swiper-slide">
                            <div class="service-image">
                                @php
                                    $gambar = $manageLayanan->gambar_layanan
                                        ? asset('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan)
                                        : asset('web/assets/img/service/01.jpg');
                                @endphp
                                <img src="{{ $gambar }}" alt="img">
                                <a href="{{ route('layanan.detail', $manageLayanan->judul_layanan) }}" class="icon">
                                    <i class="far fa-long-arrow-right"></i>
                                </a>
                                <div class="service-content">
                                    <h3>
                                        <a href="{{ route('layanan.detail', $manageLayanan->judul_layanan) }}">
                                            {{ $manageLayanan->judul_layanan }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-dot mt-5">
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Shop Section --}}
<section class="shop-section fix section-padding pt-0">
    <div class="container">
        <div class="section-title text-center">
            <div class="sub-title wow fadeInUp">
                <span>Produk Terbaru</span>
            </div>
            <h2 class="split-text right">Jelajahi Produk Kami</h2>
        </div>
        @if ($produkPerKategori->count() > 0)
            <div class="product-header mt-4 mt-md-0">
                <ul class="nav">
                    @foreach ($produkPerKategori as $index => $item)
                        <li class="nav-item wow fadeInUp" data-wow-delay="{{ $index * 0.2 + 0.2 }}s">
                            <a href="#kategori-{{ $item['kategori']->id }}" data-bs-toggle="tab" class="nav-link {{ $index === 0 ? 'active' : '' }}">
                                {{ $item['kategori']->nama_kategori }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-content">
                @foreach ($produkPerKategori as $index => $item)
                    <div id="kategori-{{ $item['kategori']->id }}" class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}">
                        <div class="row">
                            @forelse($item['produks'] as $produkIndex => $produk)
                                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $produkIndex * 0.1 + 0.2 }}s">
                                    <div class="shop-items style-2">
                                        <div class="shop-image">
                                            @php
                                                $gambar = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0
                                                    ? asset('produk/gambar/' . $produk->gambar_produk[0])
                                                    : asset('web/assets/img/shop/01.jpg');
                                            @endphp
                                            <img src="{{ $gambar }}" alt="{{ $produk->judul }}">
                                            <ul class="product-icon d-grid justify-content-center align-items-center">
                                                <li>
                                                    <a href="{{ route('shop.detail', $produk->slug) }}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            @if ($produk->diskon > 0)
                                                <div class="offer-text">-{{ $produk->diskon }}%</div>
                                            @endif
                                        </div>
                                        <div class="shop-content">
                                            <h5>
                                                <a href="{{ route('shop.detail', $produk->slug) }}">{{ $produk->judul }}</a>
                                            </h5>
                                            <ul class="price-list">
                                                @if ($produk->diskon > 0)
                                                    @php
                                                        $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon) / 100;
                                                    @endphp
                                                    <li>Rp {{ number_format($hargaDiskon, 0, ',', '.') }} <del>Rp {{ number_format($produk->harga, 0, ',', '.') }}</del></li>
                                                @else
                                                    <li>Rp {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        <p>Tidak ada produk dalam kategori ini.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        @if ($item['produks']->count() > 0)
                            <div class="text-center mt-4">
                                <a href="{{ route('shop', ['kategori' => $item['kategori']->id]) }}" class="theme-btn">
                                    Lihat Semua Produk {{ $item['kategori']->nama_kategori }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                <p>Belum ada produk yang tersedia.</p>
            </div>
        @endif
    </div>
</section>

@endsection

{{-- Style Section --}}
@section('style')
<style>
    /* ============================================
       POPUP IKLAN STYLES (Scoped to prevent conflicts)
       ============================================ */
    #popupIklan.popup-iklan-modal {
        z-index: 1055;
    }

    #popupIklan.popup-iklan-modal .modal-dialog {
        max-width: 350px;
        margin: 1rem auto;
    }

    #popupIklan.popup-iklan-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        border: none;
        max-height: 90vh;
        overflow-y: auto;
    }

    #popupIklan.popup-iklan-modal .modal-header {
        background: transparent;
        padding: 0.5rem 0.5rem 0;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 10;
        border: none;
    }

    #popupIklan.popup-iklan-modal .btn-close {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        opacity: 1;
        padding: 0.4rem;
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }

    #popupIklan.popup-iklan-modal .btn-close:hover {
        background: rgba(255, 255, 255, 1);
    }

    #popupIklan .popup-iklan-slide {
        width: 100%;
        height: 300px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        border-radius: 15px 15px 0 0;
    }

    #popupIklan .popup-iklan-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0;
    }

    #popupIklan .popup-iklan-content-inner {
        width: 100%;
        color: white;
        text-align: center;
    }

    #popupIklan .popup-iklan-title {
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    #popupIklan .popup-iklan-description {
        color: #fff;
        line-height: 1.4;
        font-size: 0.85rem;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    #popupIklan.popup-iklan-modal .carousel-control-prev,
    #popupIklan.popup-iklan-modal .carousel-control-next {
        width: 30px;
        height: 30px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        opacity: 0.8;
    }

    #popupIklan.popup-iklan-modal .carousel-control-prev {
        left: 10px;
    }

    #popupIklan.popup-iklan-modal .carousel-control-next {
        right: 10px;
    }

    #popupIklan.popup-iklan-modal .carousel-control-prev-icon,
    #popupIklan.popup-iklan-modal .carousel-control-next-icon {
        width: 15px;
        height: 15px;
    }

    #popupIklan.popup-iklan-modal .carousel-indicators {
        margin-bottom: 0.5rem;
    }

    #popupIklan.popup-iklan-modal .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
    }

    #popupIklan.popup-iklan-modal .carousel-indicators button.active {
        background-color: rgba(255, 255, 255, 1);
    }

    @media (max-width: 576px) {
        #popupIklan.popup-iklan-modal .modal-dialog {
            max-width: 300px;
            margin: 1rem auto;
        }

        #popupIklan .popup-iklan-slide {
            height: 250px;
        }

        #popupIklan .popup-iklan-title {
            font-size: 0.9rem;
        }

        #popupIklan .popup-iklan-description {
            font-size: 0.75rem;
        }
    }

    /* ============================================
       LANDING PAGE PRODUCT CARD STYLES
       ============================================ */
    .product-card-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }
    
    .product-card-link:hover {
        text-decoration: none;
        color: inherit;
    }
    
    .product-card-clickable {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product-card-link:hover .product-card-clickable {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .product-card-link .content h3 {
        transition: color 0.3s ease;
    }
    
    .product-card-link:hover .content h3 {
        color: var(--theme, #007bff);
    }
</style>
@endsection

{{-- Script Section --}}
@section('script')
{{-- Popup Iklan Script --}}
@if($manageInfos && $manageInfos->count() > 0)
<script>
    (function() {
        'use strict';
        
        // Fungsi untuk memastikan body bisa di-scroll
        function enableBodyScroll() {
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.classList.remove('modal-open');
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => backdrop.remove());
        }

        // Fungsi untuk menampilkan popup iklan
        function showPopupIklan() {
            const popupModal = document.getElementById('popupIklan');
            
            if (popupModal) {
                const existingInstance = bootstrap.Modal.getInstance(popupModal);
                if (existingInstance) {
                    existingInstance.dispose();
                }
                
                const carousel = popupModal.querySelector('#popupIklanCarousel');
                if (carousel) {
                    const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                    if (carouselInstance) {
                        carouselInstance.to(0);
                    }
                }
                
                const modalInstance = new bootstrap.Modal(popupModal, {
                    backdrop: 'static',
                    keyboard: false
                });
                
                popupModal.addEventListener('hidden.bs.modal', function() {
                    enableBodyScroll();
                });

                const closeButtons = popupModal.querySelectorAll('[data-bs-dismiss="modal"]');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        setTimeout(function() {
                            enableBodyScroll();
                        }, 100);
                    });
                });
                
                setTimeout(function() {
                    modalInstance.show();
                }, 800);
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            showPopupIklan();
        });

        window.addEventListener('load', function() {
            const activeModal = document.querySelector('.popup-iklan-modal.show');
            if (!activeModal) {
                setTimeout(function() {
                    showPopupIklan();
                }, 500);
            }
        });

        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                enableBodyScroll();
                setTimeout(function() {
                    showPopupIklan();
                }, 500);
            }
        });

        window.addEventListener('load', function() {
            setTimeout(function() {
                enableBodyScroll();
            }, 100);
        });
    })();
</script>
@endif

{{-- Leaflet Map Script --}}
@if (isset($profil) && $profil->latitude && $profil->longitude)
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        (function() {
            'use strict';
            var map = L.map('map').setView([{{ $profil->latitude }}, {{ $profil->longitude }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([{{ $profil->latitude }}, {{ $profil->longitude }}]).addTo(map);
            marker.bindPopup(`
                <div class="text-center">
                    <h6 class="mb-2">{{ $profil->nama_perusahaan ?? 'Perusahaan' }}</h6>
                    <p class="mb-1"><small>{{ $profil->alamat_perusahaan ?? '' }}</small></p>
                    @if ($profil->no_telp_perusahaan)
                    <p class="mb-0"><small>{{ $profil->no_telp_perusahaan }}</small></p>
                    @endif
                </div>
            `).openPopup();

            var circle = L.circle([{{ $profil->latitude }}, {{ $profil->longitude }}], {
                color: '#007bff',
                fillColor: '#007bff',
                fillOpacity: 0.1,
                radius: 500
            }).addTo(map);
        })();
    </script>
@endif
@endsection
