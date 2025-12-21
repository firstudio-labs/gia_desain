@extends('template_web.layout')
@section('content')
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Riwayat Pesanan</h1>
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
                            Riwayat Pesanan
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
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center mb-4">
                            <div class="sub-title wow fadeInUp">
                                <span>Riwayat Pesanan Saya</span>
                            </div>
                            <h2 class="split-text right wow fadeInUp" data-wow-delay=".3s">
                                Daftar Pesanan
                            </h2>
                        </div>

                        @if($pesanans->count() > 0)
                            <div class="table-responsive wow fadeInUp" data-wow-delay=".5s">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>Status</th>
                                            <th>Jumlah Item</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesanans as $pesanan)
                                            <tr>
                                                <td>
                                                    <strong>{{ $pesanan->order_id }}</strong>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}
                                                </td>
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
                                                <td>
                                                    <span class="badge bg-primary">{{ $pesanan->quantity }} item</span>
                                                </td>
                                                <td>
                                                    <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('riwayat-pesanan.detail', $pesanan->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="far fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 wow fadeInUp" data-wow-delay=".5s">
                                <div class="mb-4">
                                    <i class="far fa-shopping-bag" style="font-size: 64px; color: #ccc;"></i>
                                </div>
                                <h4>Belum Ada Pesanan</h4>
                                <p class="text-muted">Anda belum memiliki riwayat pesanan.</p>
                                <a href="{{ route('shop') }}" class="theme-btn mt-3">
                                    <i class="far fa-shopping-cart"></i> Mulai Belanja
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
