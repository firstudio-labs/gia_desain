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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Profil</a></li>
                <li class="breadcrumb-item" aria-current="page">Tabel Data Profil</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Tabel Data Profil</h2>
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
                <h5 class="mb-0">Tabel Data Profil</h5>
                @if($profils->count() == 0)
                <a href="{{ route('profil-perusahaan.create') }}" class="btn btn-primary">Tambah Data Profil</a>
                @endif
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

              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Perusahaan</th>
                      <th>No. Telepon</th>
                      <th>Logo Perusahaan</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Koordinat</th>
                      <th>Media Sosial</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($profils as $e => $profil)
                    <tr>
                      <td>{{ $e+1 }}</td>
                      <td>{{ $profil->nama_perusahaan }}</td>
                      <td>{{ $profil->no_telp_perusahaan }}</td>
                      <td>
                        <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="Logo Perusahaan" class="img-fluid" style="max-width: 100px;">
                      </td>
                      <td>{{ $profil->email_perusahaan }}</td>
                      <td>{{ $profil->alamat_perusahaan }}</td>
                      <td>{{ $profil->latitude }}, {{ $profil->longitude }}</td>
                      <td>
                        <div class="d-flex gap-2">
                          @if($profil->instagram_perusahaan)
                            <a href="{{ $profil->instagram_perusahaan }}" target="_blank" class="btn btn-sm btn-danger">
                              <i class="fab fa-instagram"></i>
                            </a>
                          @endif
                          @if($profil->facebook_perusahaan)
                            <a href="{{ $profil->facebook_perusahaan }}" target="_blank" class="btn btn-sm btn-primary">
                              <i class="fab fa-facebook-f"></i>
                            </a>
                          @endif
                          @if($profil->twitter_perusahaan)
                            <a href="{{ $profil->twitter_perusahaan }}" target="_blank" class="btn btn-sm btn-info">
                              <i class="fab fa-twitter"></i>
                            </a>
                          @endif
                          @if($profil->linkedin_perusahaan)
                            <a href="{{ $profil->linkedin_perusahaan }}" target="_blank" class="btn btn-sm btn-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448.5 209.9c-44 .1-87-13.6-122.8-39.2l0 178.7c0 33.1-10.1 65.4-29 92.6s-45.6 48-76.6 59.6-64.8 13.5-96.9 5.3-60.9-25.9-82.7-50.8-35.3-56-39-88.9 2.9-66.1 18.6-95.2 40-52.7 69.6-67.7 62.9-20.5 95.7-16l0 89.9c-15-4.7-31.1-4.6-46 .4s-27.9 14.6-37 27.3-14 28.1-13.9 43.9 5.2 31 14.5 43.7 22.4 22.1 37.4 26.9 31.1 4.8 46-.1 28-14.4 37.2-27.1 14.2-28.1 14.2-43.8l0-349.4 88 0c-.1 7.4 .6 14.9 1.9 22.2 3.1 16.3 9.4 31.9 18.7 45.7s21.3 25.6 35.2 34.6c19.9 13.1 43.2 20.1 67 20.1l0 87.4z"/></svg>
                            </a>
                          @endif
                        </div>
                      </td>
                      <td>
                        <a href="{{ route('profil-perusahaan.show', $profil->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('profil-perusahaan.edit', $profil->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('profil-perusahaan.destroy', $profil->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Nama Perusahaan</th>
                      <th>No. Telepon</th>
                      <th>Logo Perusahaan</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>Koordinat</th>
                      <th>Media Sosial</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Zero config table end -->
      </div>
    </div>
  </section>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
  <script>
    $(document).ready(function() {
      $('#simpletable').DataTable();
    });
  </script>
  @endsection