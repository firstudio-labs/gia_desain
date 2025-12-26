@extends('template_web.layout')
@section('content')
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Kontak Kami</h1>
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
                            Kontak
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info Section Start -->
    <section class="contact-page-wrap section-padding">
        <div class="container">
            <div class="row g-4 contact-cards-row">
                @if($profil && $profil->email_perusahaan)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-card card1 h-100">
                        <div class="top-part">
                            <div class="icon">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="title">
                                <h4>Email Address</h4>
                                <span>Kirim email kapan saja</span>
                            </div>
                        </div>
                        <div class="bottom-part">                            
                            <div class="info">
                                <p class="mb-0"><a href="mailto:{{ $profil->email_perusahaan }}" class="text-decoration-none contact-link">{{ $profil->email_perusahaan }}</a></p>
                            </div>
                            <div class="icon">
                                <i class="fal fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($profil && $profil->no_telp_perusahaan)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-card card2 h-100">
                        <div class="top-part">
                            <div class="icon">
                                <i class="fal fa-phone"></i>
                            </div>
                            <div class="title">
                                <h4>Nomor Telepon</h4>
                                <span>Hubungi kami kapan saja</span>
                            </div>
                        </div>
                        <div class="bottom-part">                            
                            <div class="info">
                                <p class="mb-0"><a href="tel:{{ $profil->no_telp_perusahaan }}" class="text-decoration-none contact-link">{{ $profil->no_telp_perusahaan }}</a></p>
                            </div>
                            <div class="icon">
                                <i class="fal fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($profil && $profil->alamat_perusahaan)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-card card3 h-100">
                        <div class="top-part">
                            <div class="icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="title">
                                <h4>Alamat Kantor</h4>
                                <span>Kunjungi kami kapan saja</span>
                            </div>
                        </div>
                        <div class="bottom-part">                            
                            <div class="info">
                                <p class="mb-0">{{ $profil->alamat_perusahaan }}</p>
                            </div>
                            <div class="icon">
                                <i class="fal fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Section Start -->
    <section class="contact-section-2 fix section-padding pt-0">
        <div class="container">
            <div class="contact-form-items">
                <div class="title text-center">
                    <h2 class="split-text right">Mari Berhubungan</h2>
                    <p>Alamat email Anda tidak akan dipublikasikan. Field yang wajib diisi ditandai dengan *</p>
                </div>
                <form action="{{ route('kontak.store') }}" method="POST" id="kontakForm">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="form-clt">
                                <input type="text" 
                                       name="nama" 
                                       id="nama" 
                                       placeholder="Nama Anda*"
                                       class="@error('nama') is-invalid @enderror"
                                       value="{{ old('nama') }}"
                                       required>
                                @error('nama')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-clt">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       placeholder="Email Anda*"
                                       class="@error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-clt">
                                <input type="text" 
                                       name="subjek" 
                                       id="subjek" 
                                       placeholder="Subjek*"
                                       class="@error('subjek') is-invalid @enderror"
                                       value="{{ old('subjek') }}"
                                       required>
                                @error('subjek')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-clt">
                                <textarea name="pesan" 
                                          id="pesan" 
                                          placeholder="Tulis Pesan*"
                                          class="@error('pesan') is-invalid @enderror"
                                          required>{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-captcha" data-sitekey="{{ $hcaptchaSiteKey ?? '3c982cb8-bc8a-4204-bfe2-2178e2ea53a8' }}"></div>
                            @error('h-captcha-response')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-7">
                            <button type="submit" class="theme-btn" id="submitBtn">
                                KIRIM PESAN ANDA
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Map Section Start -->
    @if($profil && $profil->latitude && $profil->longitude)
    <div class="office-google-map-wrapper wow fadeInUp">
        <div id="map" style="height: 500px; width: 100%; border-radius: 10px; overflow: hidden;"></div>
    </div>
    @elseif($profil && $profil->alamat_perusahaan)
    <div class="office-google-map-wrapper wow fadeInUp">
        <iframe 
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dS6fr4Jb-1qFhE&q={{ urlencode($profil->alamat_perusahaan) }}" 
            style="border:0; width: 100%; height: 500px; border-radius: 10px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
    @endif

@endsection

@section('style')
<style>
    /* ============================================
       CONTACT CARDS - EQUAL HEIGHT & RESPONSIVE
       ============================================ */
    .contact-cards-row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .contact-cards-row > [class*="col-"] {
        display: flex;
        flex-direction: column;
    }
    
    .single-contact-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 220px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .single-contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .single-contact-card .top-part {
        flex: 0 0 auto;
        margin-bottom: 20px;
    }
    
    .single-contact-card .bottom-part {
        flex: 1 1 auto;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-top: auto;
        padding-top: 15px;
    }
    
    .single-contact-card .info {
        flex: 1;
        min-width: 0;
    }
    
    .single-contact-card .info p {
        word-wrap: break-word;
        overflow-wrap: break-word;
        line-height: 1.6;
        margin: 0;
    }
    
    .single-contact-card .title h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    
    .single-contact-card .title span {
        font-size: 0.85rem;
        color: #666;
        display: block;
    }
    
    .contact-link {
        color: #333;
        transition: color 0.3s ease;
    }
    
    .single-contact-card:hover .contact-link {
        color: #fff;
    }
    
    /* Responsive adjustments */
    @media (max-width: 991px) {
        .single-contact-card {
            min-height: 200px;
        }
        
        .single-contact-card .top-part {
            margin-bottom: 15px;
        }
        
        .single-contact-card .title h4 {
            font-size: 1rem;
        }
        
        .single-contact-card .title span {
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 767px) {
        .contact-cards-row {
            gap: 20px;
        }
        
        .contact-cards-row > [class*="col-"] {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .single-contact-card {
            min-height: 180px;
            padding: 30px 25px;
        }
        
        .single-contact-card .top-part .icon {
            width: 60px;
            height: 60px;
            line-height: 60px;
            font-size: 18px;
            margin-right: 15px;
        }
        
        .single-contact-card .bottom-part .icon {
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 576px) {
        .single-contact-card {
            min-height: 170px;
            padding: 25px 20px;
        }
        
        .single-contact-card .top-part {
            margin-bottom: 12px;
        }
        
        .single-contact-card .top-part .icon {
            width: 55px;
            height: 55px;
            line-height: 55px;
            font-size: 16px;
            margin-right: 12px;
        }
        
        .single-contact-card .title h4 {
            font-size: 0.95rem;
        }
        
        .single-contact-card .title span {
            font-size: 0.75rem;
        }
        
        .single-contact-card .info p {
            font-size: 0.9rem;
        }
        
        .single-contact-card .bottom-part {
            margin-top: 10px;
            padding-top: 10px;
        }
    }
    
    /* Contact Form Responsive */
    @media (max-width: 767px) {
        .contact-form-items {
            padding: 40px 25px !important;
        }
        
        .contact-form-items .title h2 {
            font-size: 28px;
        }
        
        .contact-form-items .form-clt input,
        .contact-form-items .form-clt textarea {
            padding: 14px 20px;
            font-size: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .contact-form-items {
            padding: 30px 20px !important;
        }
        
        .contact-form-items .title h2 {
            font-size: 24px;
        }
        
        .contact-form-items .title p {
            font-size: 0.9rem;
        }
        
        .contact-form-items .form-clt input,
        .contact-form-items .form-clt textarea {
            padding: 12px 18px;
            font-size: 14px;
        }
    }
    
    /* Map Responsive */
    @media (max-width: 767px) {
        .office-google-map-wrapper #map,
        .office-google-map-wrapper iframe {
            height: 400px !important;
        }
    }
    
    @media (max-width: 576px) {
        .office-google-map-wrapper #map,
        .office-google-map-wrapper iframe {
            height: 350px !important;
        }
    }
</style>
@endsection

@section('script')
<!-- hCaptcha Script -->
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>

@if($profil && $profil->latitude && $profil->longitude)
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // Inisialisasi Leaflet untuk menampilkan lokasi
    var map = L.map('map').setView([{{ $profil->latitude }}, {{ $profil->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Menambahkan marker untuk lokasi perusahaan
    var marker = L.marker([{{ $profil->latitude }}, {{ $profil->longitude }}]).addTo(map);
    
    // Menambahkan popup dengan informasi perusahaan
    marker.bindPopup(`
        <div class="text-center">
            <h6 class="mb-2">{{ $profil->nama_perusahaan ?? 'Perusahaan' }}</h6>
            <p class="mb-1"><small>{{ $profil->alamat_perusahaan ?? '' }}</small></p>
            @if($profil->no_telp_perusahaan)
            <p class="mb-0"><small>{{ $profil->no_telp_perusahaan }}</small></p>
            @endif
        </div>
    `).openPopup();

    // Menambahkan circle untuk area sekitar
    var circle = L.circle([{{ $profil->latitude }}, {{ $profil->longitude }}], {
        color: '#007bff',
        fillColor: '#007bff',
        fillOpacity: 0.1,
        radius: 500
    }).addTo(map);
</script>
@endif

<script>
    // Disable submit button until hCaptcha is verified
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kontakForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            const hCaptchaResponse = form.querySelector('[name="h-captcha-response"]');
            if (!hCaptchaResponse || !hCaptchaResponse.value) {
                e.preventDefault();
                alert('Silakan verifikasi hCaptcha terlebih dahulu.');
                return false;
            }
        });
    });
</script>
@endsection
