@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <style>
        :root{--pri:#4F46E5;--pri-600:#4338CA;--sec:#0EA5E9;--acc:#22C55E;--warn:#F59E0B;--danger:#EF4444;--muted:#6b7280}
        .card{border:0;border-radius:12px}
        .card-header{border-bottom:0;border-top-left-radius:12px;border-top-right-radius:12px;background:linear-gradient(135deg,var(--pri),var(--sec));color:#fff}
        .btn-primary{background:var(--pri);border-color:var(--pri)}
        .btn-primary:hover{background:var(--pri-600);border-color:var(--pri-600)}
        .btn-warning{background:var(--warn);border-color:var(--warn)}
        .btn-info{background:var(--sec);border-color:var(--sec)}
        .btn-danger{background:var(--danger);border-color:var(--danger)}
        .page-header-title h2{font-weight:700}
        .breadcrumb .breadcrumb-item a{color:var(--pri)}
      </style>
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manage-produk.index') }}">Manage Produk</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Produk</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Produk</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5>Form Tambah Produk</h5>
            </div>
            <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Terjadi kesalahan!</strong> Silakan periksa form di bawah ini.
                  <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <form action="{{ route('manage-produk.store') }}" method="POST" enctype="multipart/form-data" id="produkForm">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label">Judul <span class="text-danger">*</span></label>
                      <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                      @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">SKU <span class="text-danger">*</span></label>
                      <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" required>
                      @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">Status <span class="text-danger">*</span></label>
                      <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status')==='aktif'?'selected':'' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status')==='nonaktif'?'selected':'' }}>Nonaktif</option>
                      </select>
                      @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Kategori <span class="text-danger">*</span></label>
                      <select id="kategoriSelect" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                          <option value="{{ $kategori->id }}" {{ old('kategori_id')==$kategori->id?'selected':'' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                      </select>
                      @error('kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Sub Kategori <span class="text-danger">*</span></label>
                      <select id="subKategoriSelect" name="sub_kategori_id" class="form-control @error('sub_kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Sub Kategori --</option>
                      </select>
                      @error('sub_kategori_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">Harga <span class="text-danger">*</span></label>
                      <input type="number" step="0.01" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                      @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">Diskon (%)</label>
                      <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror" value="{{ old('diskon') }}" min="0" max="100">
                      @error('diskon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Berat (kg)</label>
                      <input type="number" step="0.01" name="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}">
                      @error('berat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Ukuran</label>
                      <input type="text" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}">
                      @error('ukuran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-label">Warna</label>
                      <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" value="{{ old('warna') }}">
                      @error('warna')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                      <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
                      @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Gambar Produk</label>
                      <small class="text-danger">*Disarankan gambar dengan ratio 1:1</small>
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Tambah beberapa gambar produk</span>
                        <button type="button" class="btn btn-sm btn-success" id="addImageRow"><i class="bx bx-plus"></i> Tambah Gambar</button>
                      </div>
                      <div id="imagesContainer"></div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('manage-produk.index') }}" class="btn btn-light">Batal</a>
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
<script>
  function fetchSubKategori(kategoriId, preselected = '') {
    const subSelect = document.getElementById('subKategoriSelect');
    subSelect.innerHTML = '<option value="">Memuat...</option>';
    const url = `{{ route('ajax.sub-kategori.by-kategori') }}?kategori_id=${kategoriId}`;
    fetch(url)
      .then(r => r.json())
      .then(items => {
        subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
        items.forEach(it => {
          const opt = document.createElement('option');
          opt.value = it.id; opt.textContent = it.first_nama_sub_kategori;
          if (preselected && String(preselected) === String(it.id)) opt.selected = true;
          subSelect.appendChild(opt);
        });
      })
      .catch(() => { subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>'; });
  }

  const kategoriSelect = document.getElementById('kategoriSelect');
  kategoriSelect.addEventListener('change', function(){
    if (this.value) fetchSubKategori(this.value);
  });

  // Load sub kategori saat halaman dimuat jika ada old value (untuk mempertahankan input saat error)
  document.addEventListener('DOMContentLoaded', function(){
    const oldKategoriId = @json(old('kategori_id'));
    const oldSubKategoriId = @json(old('sub_kategori_id'));
    if (oldKategoriId) {
      fetchSubKategori(oldKategoriId, oldSubKategoriId);
    }
  });

  // Dynamic images inputs
  let imgIdx = 0;
  document.getElementById('addImageRow').addEventListener('click', function(){
    const wrap = document.getElementById('imagesContainer');
    const row = document.createElement('div');
    row.className = 'image-row mb-3 p-3 border rounded';
    row.innerHTML = `
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="mb-0">Gambar #${imgIdx + 1}</h6>
        <button type="button" class="btn btn-sm btn-danger remove-image-row"><i class="bx bx-trash"></i> Hapus</button>
      </div>
      <input type="file" name="gambar_produk[]" accept="image/*" class="form-control" />
    `;
    wrap.appendChild(row); imgIdx++;
  });

  document.addEventListener('click', function(e){
    if (e.target.closest('.remove-image-row')) {
      e.target.closest('.image-row').remove();
    }
  });
</script>
@endsection

