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
                <li class="breadcrumb-item"><a href="javascript: void(0)">User Management</a></li>
                <li class="breadcrumb-item" aria-current="page">Daftar User</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Daftar User</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar User</h5>
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

              <!-- Form Pencarian -->
              <div class="row mb-3">
                <div class="col-md-4">
                  <form method="GET" action="{{ route('daftar-user.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama, email, atau username..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-search"></i> Cari
                    </button>
                    @if(request('search'))
                      <a href="{{ route('daftar-user.index') }}" class="btn btn-secondary ms-2">
                        <i class="bx bx-x"></i> Reset
                      </a>
                    @endif
                  </form>
                </div>
              </div>

              <div class="dt-responsive table-responsive">
                <table id="daftar-user-table" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>No. WhatsApp</th>
                      <th>Role</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $e => $user)
                    <tr>
                      <td>{{ ($users->currentPage() - 1) * $users->perPage() + $e + 1 }}</td>
                      <td>
                        <div class="d-flex align-items-center">
                          @php
                            $isUrl = $user->foto_profile && filter_var($user->foto_profile, FILTER_VALIDATE_URL);
                          @endphp
                          @if($user->foto_profile && ($isUrl || file_exists(public_path('uploads/foto_profile/' . $user->foto_profile)) || file_exists(public_path('upload/foto_profile/' . $user->foto_profile))))
                            <img src="{{ $isUrl ? $user->foto_profile : (file_exists(public_path('uploads/foto_profile/' . $user->foto_profile)) ? asset('uploads/foto_profile/' . $user->foto_profile) : asset('upload/foto_profile/' . $user->foto_profile)) }}" alt="{{ $user->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                          @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                              <i class="bx bx-user"></i>
                            </div>
                          @endif
                          <strong>{{ $user->name }}</strong>
                        </div>
                      </td>
                      <td>{{ $user->username ?? '-' }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if($user->no_wa)
                          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->no_wa) }}" target="_blank" class="text-success">
                            {{ $user->no_wa }}
                            <i class="bx bx-link-external"></i>
                          </a>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
                      <td>
                        @if($user->role == 'user')
                          <span class="badge bg-primary">User</span>
                        @elseif($user->role == 'admin')
                          <span class="badge bg-info">Admin</span>
                        @else
                          <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                        @endif
                      </td>
                      <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') }}</td>
                      <td>
                        <a href="{{ route('daftar-user.show', $user->id) }}" class="btn btn-sm btn-info">
                          <i class="bx bx-show"></i> Detail
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              @if($users->hasPages())
              <div class="mt-3">
                {{ $users->links() }}
              </div>
              @endif
            </div>
          </div>
        </div>
        <!-- Zero config table end -->
      </div>
    </div>
  </section>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    // Inisialisasi DataTable dengan ID unik untuk menghindari konflik
    $('#daftar-user-table').DataTable({
      paging: false,
      searching: false,
      info: false,
      ordering: true,
      order: [[6, 'desc']],
      autoWidth: false,
      columns: [
        { width: "5%" },
        { width: "20%" },
        { width: "12%" },
        { width: "18%" },
        { width: "15%" },
        { width: "10%" },
        { width: "15%" },
        { width: "5%" }
      ],
      columnDefs: [
        { orderable: false, targets: [0, 7] }
      ],
      language: {
        emptyTable: "Tidak ada data user",
        zeroRecords: "Tidak ada data yang cocok",
        infoEmpty: "Menampilkan 0 dari 0 data",
        infoFiltered: "(disaring dari _MAX_ total data)"
      }
    });
  });
</script>
@endsection
