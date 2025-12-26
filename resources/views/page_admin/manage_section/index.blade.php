@extends('template_admin.layout')

@section('content')
<section class="pc-container">
    <div class="pc-content">
      <style>
        :root{--pri:#4F46E5;--pri-600:#4338CA;--sec:#0EA5E9;--acc:#22C55E;--warn:#F59E0B;--danger:#EF4444;--muted:#6b7280}
        .card{border:0;border-radius:12px}
        .btn-primary{background:var(--pri);border-color:var(--pri)}
        .btn-primary:hover{background:var(--pri-600);border-color:var(--pri-600)}
        .btn-warning{background:var(--warn);border-color:var(--warn)}
        .btn-info{background:var(--sec);border-color:var(--sec)}
        .btn-danger{background:var(--danger);border-color:var(--danger)}
        .badge.bg-success{background:var(--acc)!important}
        .badge.bg-secondary{background:var(--muted)!important}
        .page-header-title h2{font-weight:700}
        .breadcrumb .breadcrumb-item a{color:var(--pri)}
        table.dataTable thead th{background:#f8fafc;color:#111827}
      </style>
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard-superadmin">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Manage Section</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Data Section</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tabel Section</h5>
                @if($sections->isEmpty())
                <a href="{{ route('manage-section.create') }}" class="btn btn-primary">Tambah Section</a>
                @endif
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="simpletable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Section</th>
                      <th>Jumlah Produk</th>
                      <th>Diskon (%)</th>
                      <th>New</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sections as $e => $section)
                    <tr>
                      <td>{{ $e+1 }}</td>
                      <td>{{ $section->name }}</td>
                      <td>{{ is_array($section->product_ids) ? count($section->product_ids) : 0 }}</td>
                      <td>{{ $section->discount_percentage ?? '-' }}</td>
                      <td>{!! $section->is_new ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                      <td>
                        <a href="{{ route('manage-section.show', $section->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('manage-section.edit', $section->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('manage-section.destroy', $section->id) }}" method="POST" style="display:inline;" class="delete-form">
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
                      <th>Nama Section</th>
                      <th>Jumlah Produk</th>
                      <th>Diskon (%)</th>
                      <th>New</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
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
                    text: 'Data ini akan dihapus secara permanen!',
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
  $(document).ready(function() { $('#simpletable').DataTable(); });
</script>
@endsection

