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
                <li class="breadcrumb-item"><a href="{{ route('manage-section.index') }}">Manage Section</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Tambah Section</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Tambah Section</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-10">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5>Form Tambah Section</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-section.store') }}" method="POST" id="sectionForm">
                @csrf
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label class="form-label">Nama Section <span class="text-danger">*</span></label>
                      <select name="name" class="form-control @error('name') is-invalid @enderror" required>
                        <option value="">-- Pilih Nama Section --</option>
                        <option value="Homepage" {{ old('name') == 'Homepage' ? 'selected' : '' }}>Homepage</option>
                      
                      </select>
                      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label">Diskon (%)</label>
                      <input type="number" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage') }}" min="0" max="100">
                      @error('discount_percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-label d-block">Badge New</label>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="is_new" name="is_new" {{ old('is_new') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_new">
                          Tampilkan badge New
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label d-flex justify-content-between align-items-center">
                        <span>Pilih Produk (bisa lebih dari 1)</span>
                        <button type="button" class="btn btn-sm btn-success" id="addProductRow"><i class="bx bx-plus"></i> Tambah Produk</button>
                      </label>
                      <div id="productsContainer"></div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('manage-section.index') }}" class="btn btn-light">Batal</a>
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
  // Template select produk
  const produkOptionsHtml = `{!! collect($produks)->map(fn($p) => '<option value="'.$p->id.'">'.e($p->judul).'</option>')->implode('') !!}`;
  let prodIdx = 0;
  function makeProductRow(selected = '') {
    const row = document.createElement('div');
    row.className = 'product-row mb-2 p-2 border rounded';
    row.innerHTML = `
      <div class="d-flex gap-2 align-items-center">
        <select name="product_ids[]" class="form-control">
          <option value="">-- Pilih Produk --</option>
          ${produkOptionsHtml}
        </select>
        <button type="button" class="btn btn-sm btn-danger remove-product-row"><i class="bx bx-trash"></i></button>
      </div>
    `;
    const select = row.querySelector('select');
    if (selected) select.value = String(selected);
    return row;
  }

  document.getElementById('addProductRow').addEventListener('click', function(){
    const wrap = document.getElementById('productsContainer');
    wrap.appendChild(makeProductRow());
    prodIdx++;
  });

  document.addEventListener('click', function(e){
    if (e.target.closest('.remove-product-row')) {
      e.target.closest('.product-row')?.remove();
    }
  });

  // Tambahkan satu baris default saat load
  document.addEventListener('DOMContentLoaded', function(){
    document.getElementById('addProductRow').click();
  });
</script>
@endsection

