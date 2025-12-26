@extends('template_web.layout')
@section('content')
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover"
        style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Layanan Kami</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{ route('landing') }}">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>    
                            Layanan Kami
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Section Start -->
    <section class="service-section section-padding">
        <div class="bg-shape">
            <img src="{{ asset('web') }}/assets/img/service/bg-shape.png" alt="img">
        </div>
        <div class="container">
            <div class="service-wrapper-2">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                @php
                                    // Ambil maksimal 4 data layanan yang berbeda
                                    $layanans = $manageLayanans->take(4);
                                    // Buat array icon untuk assign ke setiap layanan
                                    $icons = ['fal fa-print', 'fal fa-desktop-alt', 'fal fa-shopping-bag', 'fal fa-user'];
                                @endphp
                                @foreach($layanans as $idx => $manageLayanan)
                                    <div class="service-box-items {{ $idx >= 2 ? 'style-2 ' : '' }}wow fadeInUp" data-wow-delay=".{{ $idx < 2 ? 3 : 5 }}s">
                                        <div class="icon">
                                            <i class="{{ $icons[$idx] ?? 'fal fa-print' }}"></i>
                                        </div>
                                        <div class="content">
                                            <h3>
                                                <a href="{{ route('layanan.detail', $manageLayanan->judul_layanan) }}">
                                                    {{ $manageLayanan->judul_layanan }}
                                                </a>
                                            </h3>
                                            <p>
                                                {{ \Illuminate\Support\Str::limit($manageLayanan->deskripsi_layanan ?? 'Deskripsi layanan belum tersedia.', 100) }}
                                            </p>
                                        </div>
                                    </div>
                                    {{-- Buka tutup kolom sesuai index --}}
                                    @if($idx == 1)
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="service-right-content">
                            <div class="section-title">
                                <div class="sub-title wow fadeInUp">
                                    <span>Layanan Kami</span>
                                </div>
                                <h2 class="split-text right">
                                    Layanan Kami <br> dan Berkualitas
                                </h2>
                            </div>
                            @if($manageLayanans->count() > 0)
                                <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                                    {{ \Illuminate\Support\Str::limit($manageLayanans->first()->deskripsi_layanan ?? 'Kami menghadirkan solusi percetakan yang praktis dan hasil terbaik untuk kebutuhan Anda.', 200) }}
                                </p>
                            @else
                                <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                                    Kami menghadirkan solusi percetakan yang praktis dan hasil terbaik untuk kebutuhan Anda.
                                </p>
                            @endif
                            <div class="icon-items wow fadeInUp" data-wow-delay=".3s">
                                <div class="icon">
                                    <i class="fab fa-whatsapp" style="color:#25D366; font-size: 2.5rem;"></i>
                                </div>
                                <div class="content">
                                    <h4>Hubungi Via WhatsApp</h4>
                                    @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                        @php
                                            $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                        @endphp
                                        <span>
                                            <a href="https://wa.me/{{ $no_wa_clean }}" target="_blank" style="color: inherit; text-decoration: none;">
                                                {{ $ownerWhatsapp->no_wa }}
                                            </a>
                                        </span>
                                    @else
                                        <span>Hubungi kami sekarang</span>
                                    @endif
                                </div>
                            </div>
                            <div class="icon-items wow fadeInUp" data-wow-delay=".5s">
                                <div class="icon">
                                    <i class="fal fa-check-circle" style="color:#25D366; font-size: 2.5rem;"></i>
                                </div>
                                <div class="content">
                                    <h4>Layanan Responsif</h4>
                                    <span>Dukungan pelanggan cepat dan profesional</span>
                                </div>
                            </div>
                            @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                @php
                                    $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                @endphp
                                <a href="https://wa.me/{{ $no_wa_clean }}" target="_blank" class="theme-btn wow fadeInUp" data-wow-delay=".3s" style="background-color:#25D366; border: none; color:#fff;">
                                    <i class="fab fa-whatsapp"></i> Hubungi Kami Sekarang
                                </a>
                            @else
                                <a href="{{ route('layanan') }}" class="theme-btn wow fadeInUp" data-wow-delay=".3s">Pelajari Lebih Lanjut</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Section Start -->
    <section class="service-section fix section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>Layanan Kami</span>
                </div>
                <h2 class="split-text right">
                    Layanan Kami <br> dan Berkualitas
                </h2>
            </div>
            <div class="service-wrapper">
                <div class="swiper service-slider">
                    <div class="swiper-wrapper">
                        @foreach($manageLayanans as $manageLayanan)
                            <div class="swiper-slide">
                                <div class="service-image">
                                    @php
                                        // Gunakan gambar dari public/gambar_layanan/gambar/, fallback ke placeholder jika tidak ada
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
@endsection

@section('style')
<style>
    /* Force all images to 1:1 aspect ratio */
    .service-image img,
    .service-image {
        aspect-ratio: 1 / 1;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    
    .service-image {
        overflow: hidden;
    }
</style>
@endsection
