@extends('template_admin.layout')
@section('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/>
@endsection
@section('content')
<section class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profil Perusahaan</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Data Profil</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Data Profil</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Informasi Perusahaan -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"><i class="bx bx-building me-2"></i>Detail Data Profil</h5>
              <div>
                <a href="{{ route('profil-perusahaan.edit', $profil->id) }}" class="btn btn-warning btn-sm">
                  <i class="bx bx-edit me-1"></i>Edit
                </a>
                <a href="{{ route('profil-perusahaan.index') }}" class="btn btn-light btn-sm">
                  <i class="bx bx-arrow-back me-1"></i>Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Logo dan Info Utama -->
                <div class="col-md-4 text-center mb-4">
                  <div class="border rounded p-3 bg-light">
                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" 
                         alt="Logo Perusahaan" 
                         class="img-fluid rounded" 
                         style="max-width: 150px; max-height: 150px; object-fit: contain;">
                  </div>
                </div>
                
                <div class="col-md-8">
                  <h4 class="text-primary mb-3">{{ $profil->nama_perusahaan }}</h4>
                  
                  <div class="row">
                    <div class="col-sm-6 mb-3">
                      <div class="d-flex align-items-center">
                        <i class="bx bx-phone text-success me-2"></i>
                        <div>
                          <small class="text-muted d-block">No. Telepon</small>
                          <strong>{{ $profil->no_telp_perusahaan }}</strong>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-6 mb-3">
                      <div class="d-flex align-items-center">
                        <i class="bx bx-envelope text-info me-2"></i>
                        <div>
                          <small class="text-muted d-block">Email</small>
                          <strong>{{ $profil->email_perusahaan }}</strong>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="d-flex align-items-start">
                      <i class="bx bx-map text-warning me-2 mt-1"></i>
                      <div>
                        <small class="text-muted d-block">Alamat</small>
                        <strong>{{ $profil->alamat_perusahaan }}</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Media Sosial -->
              <div class="row mt-4">
                <div class="col-12">
                  <h6 class="text-muted mb-3"><i class="bx bx-share-alt me-2"></i>Media Sosial</h6>
                  <div class="d-flex flex-wrap gap-2">
                    @if($profil->instagram_perusahaan)
                      <a href="{{ $profil->instagram_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-danger btn-sm" title="Instagram">
                        <i class="fab fa-instagram"></i>
                      </a>
                    @endif
                    @if($profil->facebook_perusahaan)
                      <a href="{{ $profil->facebook_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-primary btn-sm" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    @endif
                    @if($profil->twitter_perusahaan)
                      <a href="{{ $profil->twitter_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-info btn-sm" title="Twitter">
                        <i class="fab fa-twitter"></i>
                      </a>
                    @endif
                    @if($profil->linkedin_perusahaan)
                      <a href="{{ $profil->linkedin_perusahaan }}" target="_blank" class="btn btn-icon btn-outline-primary btn-sm" title="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448.5 209.9c-44 .1-87-13.6-122.8-39.2l0 178.7c0 33.1-10.1 65.4-29 92.6s-45.6 48-76.6 59.6-64.8 13.5-96.9 5.3-60.9-25.9-82.7-50.8-35.3-56-39-88.9 2.9-66.1 18.6-95.2 40-52.7 69.6-67.7 62.9-20.5 95.7-16l0 89.9c-15-4.7-31.1-4.6-46 .4s-27.9 14.6-37 27.3-14 28.1-13.9 43.9 5.2 31 14.5 43.7 22.4 22.1 37.4 26.9 31.1 4.8 46-.1 28-14.4 37.2-27.1 14.2-28.1 14.2-43.8l0-349.4 88 0c-.1 7.4 .6 14.9 1.9 22.2 3.1 16.3 9.4 31.9 18.7 45.7s21.3 25.6 35.2 34.6c19.9 13.1 43.2 20.1 67 20.1l0 87.4z"/></svg>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Peta Lokasi -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h6 class="mb-0"><i class="bx bx-map me-2"></i>Lokasi Perusahaan</h6>
            </div>
            <div class="card-body">
              @if($profil->latitude && $profil->longitude)
                <div id="map" style="height: 300px; width: 100%; border-radius: 5px;"></div>
                <div class="mt-3">
                  <div class="row text-center">
                    <div class="col-6">
                      <small class="text-muted d-block">Latitude</small>
                      <strong class="text-primary">{{ $profil->latitude }}</strong>
                    </div>
                    <div class="col-6">
                      <small class="text-muted d-block">Longitude</small>
                      <strong class="text-primary">{{ $profil->longitude }}</strong>
                    </div>
                  </div>
                </div>
              @else
                <div class="text-center py-4">
                  <i class="bx bx-map-pin text-muted" style="font-size: 3rem;"></i>
                  <p class="text-muted mt-2">Lokasi belum ditentukan</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')  
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
    <script>
        @if($profil->latitude && $profil->longitude)
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
                <h6 class="mb-2">{{ $profil->nama_perusahaan }}</h6>
                <p class="mb-1"><small>{{ $profil->alamat_perusahaan }}</small></p>
                <p class="mb-0"><small>{{ $profil->no_telp_perusahaan }}</small></p>
            </div>
        `).openPopup();

        // Menambahkan circle untuk area sekitar
        var circle = L.circle([{{ $profil->latitude }}, {{ $profil->longitude }}], {
            color: '#007bff',
            fillColor: '#007bff',
            fillOpacity: 0.1,
            radius: 500
        }).addTo(map);
        @endif
    </script>
@endsection