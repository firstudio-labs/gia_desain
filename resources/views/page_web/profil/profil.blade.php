@extends('template_web.layout')
@section('content')
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Profil Saya</h1>
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
                            Profil
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Start -->
    <section class="about-section section-padding">
        <div class="container">
            <div class="about-wrapper">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="section-title text-center mb-4">
                            <div class="sub-title wow fadeInUp">
                                <span>Kelola Profil</span>
                            </div>
                            <h2 class="split-text right wow fadeInUp" data-wow-delay=".3s">
                                Profil Saya
                            </h2>
                        </div>
                    </div>

                    <!-- Form Edit Profil -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm mb-4 wow fadeInUp" data-wow-delay=".3s">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="far fa-user me-2"></i>Edit Profil</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row g-3">
                                        <!-- Foto Profile -->
                                        <div class="col-12 text-center mb-3">
                                            <div class="position-relative d-inline-block">
                                                @php
                                                    // Check if foto_profile is a local upload or a remote URL (e.g., from Google)
                                                    $isUrl = filter_var($data->foto_profile, FILTER_VALIDATE_URL);
                                                @endphp
                                                @if($data->foto_profile && ($isUrl || file_exists(public_path('uploads/foto_profile/' . $data->foto_profile))))
                                                    <img src="{{ $isUrl ? $data->foto_profile : asset('uploads/foto_profile/' . $data->foto_profile) }}" 
                                                         alt="Foto Profile" 
                                                         class="rounded-circle" 
                                                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #6F00FD;">
                                                @else
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary text-white" 
                                                         style="width: 150px; height: 150px; border: 4px solid #6F00FD; font-size: 48px; font-weight: bold;">
                                                        {{ strtoupper(substr($data->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <label for="foto_profile" class="form-label">Ubah Foto Profile</label>
                                                <input type="file" 
                                                       class="form-control @error('foto_profile') is-invalid @enderror" 
                                                       id="foto_profile" 
                                                       name="foto_profile" 
                                                       accept="image/*"
                                                       onchange="previewImage(this)">
                                                <small class="text-muted">Format: JPG, PNG, GIF, SVG (Max: 2MB)</small>
                                                @error('foto_profile')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Nama -->
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $data->name) }}" 
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Username -->
                                        <div class="col-md-6">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('username') is-invalid @enderror" 
                                                   id="username" 
                                                   name="username" 
                                                   value="{{ old('username', $data->username) }}" 
                                                   required>
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $data->email) }}" 
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- No WhatsApp -->
                                        <div class="col-md-6">
                                            <label for="no_wa" class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control @error('no_wa') is-invalid @enderror" 
                                                   id="no_wa" 
                                                   name="no_wa" 
                                                   value="{{ old('no_wa', $data->no_wa) }}" 
                                                   required>
                                            @error('no_wa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="far fa-save me-2"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Form Ubah Password -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 wow fadeInUp" data-wow-delay=".5s">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0"><i class="far fa-lock me-2"></i>Ubah Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profil.update-password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Password Lama <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required>
                                        <small class="text-muted">Minimal 8 karakter</small>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required>
                                    </div>

                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="far fa-key me-2"></i>Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="card shadow-sm wow fadeInUp" data-wow-delay=".7s">
                            <div class="card-body text-center">
                                <h6 class="mb-3">Informasi Akun</h6>
                                <p class="mb-2">
                                    <small class="text-muted">Bergabung sejak</small><br>
                                    <strong>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</strong>
                                </p>
                                <hr>
                                <a href="{{ route('riwayat-pesanan.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="far fa-shopping-bag me-2"></i>Riwayat Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('style')
<style>
    /* Force profile image to 1:1 aspect ratio */
    .position-relative.d-inline-block img {
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
</style>
@endsection

@section('script')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = input.closest('.col-12').querySelector('img');
                if (img) {
                    img.src = e.target.result;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
