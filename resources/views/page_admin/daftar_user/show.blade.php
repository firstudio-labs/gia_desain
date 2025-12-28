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
                <li class="breadcrumb-item"><a href="{{ route('daftar-user.index') }}">Daftar User</a></li>
                <li class="breadcrumb-item" aria-current="page">Detail User</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detail User</h2>
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
              <h5 class="mb-0">Detail User - {{ $user->name }}</h5>
              <div>
                <a href="{{ route('daftar-user.index') }}" class="btn btn-light">
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
                <!-- Informasi User -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-primary text-white">
                      <h6 class="mb-0"><i class="bx bx-user me-2"></i>Informasi User</h6>
                    </div>
                    <div class="card-body">
                      <div class="text-center mb-4">
                        @php
                          $isUrl = $user->foto_profile && filter_var($user->foto_profile, FILTER_VALIDATE_URL);
                        @endphp
                        @if($user->foto_profile && ($isUrl || file_exists(public_path('uploads/foto_profile/' . $user->foto_profile)) || file_exists(public_path('upload/foto_profile/' . $user->foto_profile))))
                          <img src="{{ $isUrl ? $user->foto_profile : (file_exists(public_path('uploads/foto_profile/' . $user->foto_profile)) ? asset('uploads/foto_profile/' . $user->foto_profile) : asset('upload/foto_profile/' . $user->foto_profile)) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                          <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px; font-size: 48px;">
                            <i class="bx bx-user"></i>
                          </div>
                        @endif
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Nama Lengkap</label>
                        <strong>{{ $user->name }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Username</label>
                        <strong>{{ $user->username ?? '-' }}</strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Email</label>
                        <strong>{{ $user->email }}</strong>
                      </div>
                      @if($user->no_wa)
                      <div class="mb-3">
                        <label class="text-muted small d-block">No. WhatsApp</label>
                        <strong>
                          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->no_wa) }}" target="_blank" class="text-success">
                            {{ $user->no_wa }}
                            <i class="bx bx-link-external"></i>
                          </a>
                        </strong>
                      </div>
                      @endif
                      <div class="mb-3">
                        <label class="text-muted small d-block">Role</label>
                        <strong>
                          @if($user->role == 'user')
                            <span class="badge bg-primary">User</span>
                          @elseif($user->role == 'admin')
                            <span class="badge bg-info">Admin</span>
                          @else
                            <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                          @endif
                        </strong>
                      </div>
                      <div class="mb-3">
                        <label class="text-muted small d-block">Tanggal Daftar</label>
                        <strong>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') }}</strong>
                      </div>
                      @if($user->email_verified_at)
                      <div class="mb-3">
                        <label class="text-muted small d-block">Email Verified</label>
                        <strong>
                          <span class="badge bg-success">
                            {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y, H:i') }}
                          </span>
                        </strong>
                      </div>
                      @endif
                  </div>
                </div>
              </div>

                <!-- Statistik Pesanan -->
                <div class="col-md-6 mb-4">
                  <div class="card border">
                    <div class="card-header bg-info text-white">
                      <h6 class="mb-0"><i class="bx bx-bar-chart me-2"></i>Statistik Pesanan</h6>
                    </div>
                    <div class="card-body">
                      <div class="row g-3">
                        <div class="col-6">
                          <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                              <h3 class="mb-0">{{ $totalPesanan }}</h3>
                              <small>Total Pesanan</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                              <h3 class="mb-0">{{ $pesananPending }}</h3>
                              <small>Pending</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="card bg-info text-white">
                            <div class="card-body text-center">
                              <h3 class="mb-0">{{ $pesananProses }}</h3>
                              <small>Proses</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="card bg-success text-white">
                            <div class="card-body text-center">
                              <h3 class="mb-0">{{ $pesananSelesai }}</h3>
                              <small>Selesai</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="card bg-gradient-primary text-white">
                            <div class="card-body text-center">
                              <h4 class="mb-0">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</h4>
                              <small>Total Belanja (Selesai)</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Riwayat Pesanan -->
              <div class="row">
                <div class="col-12">
                  <div class="card border">
                    <div class="card-header bg-success text-white">
                      <h6 class="mb-0"><i class="bx bx-shopping-bag me-2"></i>Riwayat Pesanan</h6>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Order ID</th>
                              <th>Tanggal Pesanan</th>
                              <th>Status</th>
                              <th>Jumlah Item</th>
                              <th>Total</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($pesanans as $index => $pesanan)
                              <tr>
                                <td>{{ ($pesanans->currentPage() - 1) * $pesanans->perPage() + $index + 1 }}</td>
                                <td><strong>{{ $pesanan->order_id }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</td>
                                <td>
                                  @if($pesanan->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                  @elseif($pesanan->status == 'proses')
                                    <span class="badge bg-info">Proses</span>
                                  @elseif($pesanan->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                  @else
                                    <span class="badge bg-secondary">{{ $pesanan->status }}</span>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <span class="badge bg-primary">{{ $pesanan->quantity }} item</span>
                                </td>
                                <td class="text-end">
                                  <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                  <a href="{{ route('daftar-riwayat-pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i> Detail
                                  </a>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="7" class="text-center">Belum ada pesanan</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>

                      <!-- Pagination -->
                      @if($pesanans->hasPages())
                      <div class="mt-3">
                        {{ $pesanans->links() }}
                      </div>
                      @endif
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
