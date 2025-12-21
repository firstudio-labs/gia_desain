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
                <li class="breadcrumb-item"><a href="{{ route('daftar-riwayat-pesanan.index') }}">Riwayat Pesanan</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail Pesanan</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail Pesanan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Detail Pesanan - {{ $pesanan->order_id }}</h5>
              <div>
                <a href="{{ route('daftar-riwayat-pesanan.index') }}" class="btn btn-light">
                  <i class="bx bx-arrow-back"></i> Kembali
                </a>
              </div>
            </div>
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <div class="row">
                <!-- Informasi Customer -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-primary text-white">
                      <h6 class="mb-0"><i class="bx bx-user me-2 text-light" style="color: #fff;"></i>Informasi Customer</h6>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="text-muted small d-block">Nama</label>
                        <strong>{{ $pesanan->user->name ?? 'N/A' }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Email</label>
                        <strong>{{ $pesanan->user->email ?? 'N/A' }}</strong>
                      </div>
                      @if($pesanan->user && $pesanan->user->no_wa)
                      <div class="mb-3">
                        <label class="text-muted small d-block">No. WhatsApp</label>
                        <strong>
                          <a href="https://wa.me/{{ $pesanan->user->no_wa }}" target="_blank" class="text-success">
                            {{ $pesanan->user->no_wa }}
                            <i class="bx bx-link-external"></i>
                          </a>
                        </strong>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>

                <!-- Informasi Pesanan -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-info text-white">
                      <h6 class="mb-0"><i class="bx bx-info-circle me-2 text-light" style="color: #fff;"></i>Informasi Pesanan</h6>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="text-muted small d-block">Order ID</label>
                        <strong>{{ $pesanan->order_id }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Tanggal Pesanan</label>
                        <strong>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Total Item</label>
                        <strong><span class="badge bg-primary">{{ $pesanan->quantity }} item</span></strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Status</label>
                        <strong>
                          @if($pesanan->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                          @elseif($pesanan->status == 'proses')
                            <span class="badge bg-info">Proses</span>
                          @elseif($pesanan->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                          @else
                            <span class="badge bg-secondary">{{ $pesanan->status }}</span>
                          @endif
                        </strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Form Update Status -->
              <div class="row mb-4">
                <div class="col-12">
                  <div class="card border">
                    <div class="card-header bg-warning text-white">
                      <h6 class="mb-0"><i class="bx bx-edit me-2 text-white" style="color: #fff;"></i>Ubah Status Pesanan</h6>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('daftar-riwayat-pesanan.update-status', $pesanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row align-items-end">
                          <div class="col-md-4">
                            <label class="form-label">Status Saat Ini</label>
                            <div>
                              @if($pesanan->status == 'pending')
                                <span class="badge bg-warning fs-6">Pending</span>
                              @elseif($pesanan->status == 'proses')
                                <span class="badge bg-info fs-6">Proses</span>
                              @elseif($pesanan->status == 'selesai')
                                <span class="badge bg-success fs-6">Selesai</span>
                              @else
                                <span class="badge bg-secondary fs-6">{{ $pesanan->status }}</span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label for="status" class="form-label">Ubah Status Ke</label>
                            <select name="status" id="status" class="form-select" required>
                              <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="proses" {{ $pesanan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                              <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                              <i class="bx bx-save"></i> Update Status
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Detail Produk -->
              <div class="row">
                <div class="col-12">
                  <div class="card border">
                    <div class="card-header bg-success text-white">
                      <h6 class="mb-0"><i class="bx bx-package me-2 text-white" style="color: #fff;"></i>Detail Produk</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Produk</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-end">Harga Satuan</th>
                              <th class="text-end">Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $items = is_array($pesanan->produk_items) ? $pesanan->produk_items : json_decode($pesanan->produk_items, true);
                            @endphp
                            @forelse($items as $index => $item)
                              <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                  <strong>{{ $item['judul'] ?? 'N/A' }}</strong>
                                  @if(isset($item['produk_id']))
                                    <br><small class="text-muted">ID: {{ $item['produk_id'] }}</small>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <span class="badge bg-secondary">{{ $item['quantity'] ?? 0 }}</span>
                                </td>
                                <td class="text-end">
                                  Rp {{ number_format($item['harga'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                  <strong>Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}</strong>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="5" class="text-center">Tidak ada item produk</td>
                              </tr>
                            @endforelse
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
                              <td class="text-end"><strong>Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-end"><strong>Total:</strong></td>
                              <td class="text-end">
                                <strong class="text-primary" style="font-size: 1.2em;">
                                  Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                </strong>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
