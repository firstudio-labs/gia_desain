@extends('template_web.layout')
@section('content')
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Detail Pesanan</h1>
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
                            <a href="{{ route('riwayat-pesanan.index') }}">
                                Riwayat Pesanan
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            Detail Pesanan
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
                        <div class="section-title mb-4">
                            <div class="sub-title wow fadeInUp">
                                <span>Detail Pesanan</span>
                            </div>
                            <h2 class="split-text right wow fadeInUp" data-wow-delay=".3s">
                                Order ID: {{ $pesanan->order_id }}
                            </h2>
                        </div>

                        <div class="row g-4">
                            <!-- Informasi Pesanan -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm mb-4 wow fadeInUp" data-wow-delay=".3s">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="far fa-shopping-bag me-2"></i>Detail Produk</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Produk</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-end">Harga</th>
                                                        <th class="text-end">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $items = is_array($pesanan->produk_items) ? $pesanan->produk_items : json_decode($pesanan->produk_items, true);
                                                    @endphp
                                                    @foreach($items as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                <strong>{{ $item['judul'] ?? 'N/A' }}</strong>
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
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ringkasan Pesanan -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm mb-4 wow fadeInUp" data-wow-delay=".5s">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="far fa-info-circle me-2"></i>Informasi Pesanan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="text-muted small">Order ID</label>
                                            <p class="mb-0"><strong>{{ $pesanan->order_id }}</strong></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Tanggal Pesanan</label>
                                            <p class="mb-0">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Total Item</label>
                                            <p class="mb-0"><span class="badge bg-primary">{{ $pesanan->quantity }} item</span></p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small">Status</label>
                                            <p class="mb-0">
                                                @if($pesanan->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($pesanan->status == 'proses')
                                                    <span class="badge bg-info">Proses</span>
                                                @elseif($pesanan->status == 'selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $pesanan->status }}</span>
                                                @endif
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">Subtotal:</span>
                                                <strong>Rp {{ number_format($pesanan->sub_total, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">Total:</span>
                                                <strong class="text-primary" style="font-size: 1.2em;">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow-sm wow fadeInUp" data-wow-delay=".7s">
                                    <div class="card-body text-center">
                                        @if($pesanan->status == 'selesai')
                                            <a href="{{ route('riwayat-pesanan.invoice', $pesanan->id) }}" target="_blank" class="btn btn-success w-100 mb-2">
                                                <i class="far fa-file-invoice me-2"></i>Cetak Invoice
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-success w-100 mb-2" disabled title="Invoice hanya dapat dicetak jika status pesanan sudah selesai">
                                                <i class="far fa-file-invoice me-2"></i>Cetak Invoice
                                            </button>
                                        @endif

                                        @if($pesanan->status == 'proses')
                                            <form action="{{ route('riwayat-pesanan.update-status', $pesanan->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Apakah Anda yakin ingin mengubah status pesanan menjadi selesai?')">
                                                    <i class="far fa-check-circle me-2"></i>Ubah Status ke Selesai
                                                </button>
                                            </form>
                                        @endif

                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <a href="{{ route('riwayat-pesanan.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                                            <i class="far fa-arrow-left me-2"></i>Kembali ke Riwayat
                                        </a>
                                        <a href="{{ route('shop') }}" class="btn btn-primary w-100">
                                            <i class="far fa-shopping-cart me-2"></i>Belanja Lagi
                                        </a>
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
