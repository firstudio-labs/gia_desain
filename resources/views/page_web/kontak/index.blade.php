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
            <div class="row g-4">
                @if($profil && $profil->email_perusahaan)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-contact-card card1">
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
                                <p><a href="mailto:{{ $profil->email_perusahaan }}" class="text-decoration-none text-dark">{{ $profil->email_perusahaan }}</a></p>
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
                    <div class="single-contact-card card2">
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
                                <p><a href="tel:{{ $profil->no_telp_perusahaan }}" class="text-decoration-none text-dark">{{ $profil->no_telp_perusahaan }}</a></p>
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
                    <div class="single-contact-card card3">
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
                                <p>{{ $profil->alamat_perusahaan }}</p>
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
                    <h2 class="split-text right">Hubungi Kami</h2>
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
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
    @elseif($profil && $profil->alamat_perusahaan)
    <div class="office-google-map-wrapper wow fadeInUp">
        <iframe 
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dS6fr4Jb-1qFhE&q={{ urlencode($profil->alamat_perusahaan) }}" 
            style="border:0; width: 100%; height: 500px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
    @endif

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
