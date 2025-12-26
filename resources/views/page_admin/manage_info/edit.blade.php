@extends('template_admin.layout')

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
                <li class="breadcrumb-item"><a href="{{ route('manage-info.index') }}">Manage Info</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Info</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Info</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row justify-content-center">
        <!-- [ form-element ] start -->
        <div class="col-sm-10">
          <!-- Basic Inputs -->
          <div class="card">
            <div class="card-header">
              <h5>Form Edit Info</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-info.update', $manageInfo->id) }}" method="POST" enctype="multipart/form-data" id="infoForm">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Judul <span class="text-danger">*</span></label>
                      <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $manageInfo->judul) }}" placeholder="Masukkan judul" required>
                      @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Deskripsi</label>
                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" placeholder="Masukkan deskripsi">{{ old('deskripsi', $manageInfo->deskripsi) }}</textarea>
                      @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Gambar</label>
                      <small class="text-danger">*Disarankan gambar dengan ratio 1:1</small>
                      @if($manageInfo->gambar)
                        <div class="mb-2">
                          <img src="{{ asset('info/gambar/'.$manageInfo->gambar) }}" alt="gambar" style="height:80px;border-radius:6px">
                        </div>
                      @endif
                      <input type="file" name="gambar" accept="image/*" class="form-control @error('gambar') is-invalid @enderror">
                      <small class="text-muted">Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB</small>
                      @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status', $manageInfo->status)==='aktif'?'selected':'' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $manageInfo->status)==='nonaktif'?'selected':'' }}>Nonaktif</option>
                      </select>
                      @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Simpan</button>
                  <a href="{{ route('manage-info.index') }}" class="btn btn-light">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
@endsection
