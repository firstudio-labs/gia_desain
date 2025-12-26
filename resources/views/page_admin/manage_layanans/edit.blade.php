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
                <li class="breadcrumb-item"><a href="/dashboard-asisten">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manage-layanan.index') }}">Layanan</a></li>
                <li class="breadcrumb-item" aria-current="page">Form Edit Data Layanan</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Form Edit Data Layanan</h2>
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
              <h5>Form Edit Data Layanan</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('manage-layanan.update', $manageLayanan->id) }}" method="POST" id="layananForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Judul Layanan <span class="text-danger">*</span></label>
                      <input type="text" name="judul_layanan" class="form-control @error('judul_layanan') is-invalid @enderror" value="{{ old('judul_layanan', $manageLayanan->judul_layanan) }}" placeholder="Masukkan judul layanan" required>
                      @error('judul_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Deskripsi Layanan <span class="text-danger">*</span></label>
                      <textarea name="deskripsi_layanan" class="form-control @error('deskripsi_layanan') is-invalid @enderror" rows="5" placeholder="Masukkan deskripsi layanan" required>{{ old('deskripsi_layanan', $manageLayanan->deskripsi_layanan) }}</textarea>
                      @error('deskripsi_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">Gambar Layanan</label>
                      <small class="text-danger">*Disarankan gambar dengan ratio 1:1</small>
                      @if($manageLayanan->gambar_layanan)
                        <div class="mb-2">
                          <label class="form-label">Gambar Saat Ini:</label>
                          <div>
                              <img src="{{ asset('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan) }}" alt="Gambar Layanan" class="img-thumbnail" style="max-width: 300px; max-height: 300px;" id="currentImage">
                          </div>
                        </div>
                      @endif
                      <input type="file" name="gambar_layanan" class="form-control @error('gambar_layanan') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(this, 'previewGambar')">
                      <small class="text-muted">Format: JPG, JPEG, PNG, GIF, SVG. Maksimal 2MB</small>
                      @error('gambar_layanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <div class="mt-2" id="previewGambarContainer" style="display: none;">
                        <label class="form-label">Preview Gambar Baru:</label>
                        <img id="previewGambar" src="" alt="Preview Gambar" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- FAQ Section -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label">FAQ (Frequently Asked Questions)</label>
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Tambahkan pertanyaan dan jawaban yang sering ditanyakan</span>
                        <button type="button" class="btn btn-sm btn-success" id="addFaqRow">
                          <i class="bx bx-plus"></i> Tambah FAQ
                        </button>
                      </div>
                      <div id="faqContainer">
                        @php
                          $faqIndex = 0;
                        @endphp
                        @if($manageLayanan->faq && is_array($manageLayanan->faq) && count($manageLayanan->faq) > 0)
                          @foreach($manageLayanan->faq as $index => $faq)
                            <div class="faq-row mb-3 p-3 border rounded" data-index="{{ $index }}">
                              <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">FAQ #{{ $index + 1 }}</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-faq-row">
                                  <i class="bx bx-trash"></i> Hapus
                                </button>
                              </div>
                              <div class="row">
                                <div class="col-md-12 mb-2">
                                  <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                                  <input type="text" name="faq[{{ $index }}][pertanyaan]" class="form-control" value="{{ old('faq.'.$index.'.pertanyaan', $faq['pertanyaan'] ?? '') }}" placeholder="Masukkan pertanyaan" required>
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                                  <textarea name="faq[{{ $index }}][jawaban]" class="form-control" rows="3" placeholder="Masukkan jawaban" required>{{ old('faq.'.$index.'.jawaban', $faq['jawaban'] ?? '') }}</textarea>
                                </div>
                              </div>
                            </div>
                            @php
                              $faqIndex = $index + 1;
                            @endphp
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary me-2">Submit</button>
                  <a href="{{ route('manage-layanan.index') }}" class="btn btn-light">Batal</a>
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
    // Preview Image Function
    function previewImage(input, previewId) {
        const container = document.getElementById(previewId + 'Container');
        const preview = document.getElementById(previewId);
        const currentImage = document.getElementById('currentImage');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.style.display = 'block';
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            container.style.display = 'none';
            if (currentImage) {
                currentImage.style.opacity = '1';
            }
        }
    }

    let faqIndex = {{ isset($faqIndex) ? $faqIndex : 0 }};

    // Add FAQ Row
    document.getElementById('addFaqRow').addEventListener('click', function() {
        const container = document.getElementById('faqContainer');
        const faqRow = document.createElement('div');
        faqRow.className = 'faq-row mb-3 p-3 border rounded';
        faqRow.setAttribute('data-index', faqIndex);
        
        faqRow.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">FAQ #${faqIndex + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-faq-row">
                    <i class="bx bx-trash"></i> Hapus
                </button>
            </div>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                    <input type="text" name="faq[${faqIndex}][pertanyaan]" class="form-control" placeholder="Masukkan pertanyaan" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                    <textarea name="faq[${faqIndex}][jawaban]" class="form-control" rows="3" placeholder="Masukkan jawaban" required></textarea>
                </div>
            </div>
        `;
        
        container.appendChild(faqRow);
        faqIndex++;
        
        // Add event listener to remove button
        faqRow.querySelector('.remove-faq-row').addEventListener('click', function() {
            faqRow.remove();
            updateFaqNumbers();
        });
    });

    // Remove FAQ Row
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-faq-row')) {
            e.target.closest('.faq-row').remove();
            updateFaqNumbers();
        }
    });

    // Update FAQ numbers
    function updateFaqNumbers() {
        const rows = document.querySelectorAll('.faq-row');
        rows.forEach((row, index) => {
            const header = row.querySelector('h6');
            if (header) {
                header.textContent = `FAQ #${index + 1}`;
            }
        });
    }

    // Handle form submission - remove empty FAQ rows
    document.getElementById('layananForm').addEventListener('submit', function(e) {
        const faqRows = document.querySelectorAll('.faq-row');
        faqRows.forEach(row => {
            const pertanyaan = row.querySelector('input[name*="[pertanyaan]"]').value.trim();
            const jawaban = row.querySelector('textarea[name*="[jawaban]"]').value.trim();
            
            if (!pertanyaan || !jawaban) {
                row.remove();
            }
        });
    });
</script>
@endsection
