@extends('template_web.layout')
@section('content')
     <!--<< Breadcrumb Section Start >>-->
     <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">Belanja</h1>
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
                            Belanja
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section Start -->
    <section class="shop-section fix section-padding">
        <div class="container">
            <div class="row g-5">
                <!-- Sidebar -->
                <div class="col-lg-4 order-2 order-md-1">
                    <div class="shop-main-sidebar">
                        <!-- Search Widget -->
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>Cari Produk</h4>
                            </div>
                            <div class="search_widget">
                                <form action="{{ route('shop') }}" method="GET">
                                    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
                                    <button type="submit"><i class="fal fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Categories Widget -->
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>Kategori</h4>
                            </div>
                            <div class="shop-catagory-items">
                                <ul>
                                    <li>
                                        <a href="{{ route('shop') }}">Semua Kategori</a>
                                    </li>
                                    @foreach($kategoris as $kategori)
                                        <li>
                                            <a href="{{ route('shop', ['kategori' => $kategori->id]) }}" class="{{ request('kategori') == $kategori->id ? 'active' : '' }}">
                                                {{ $kategori->nama_kategori }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        

```
                        
                        <!-- Filter By Size -->
                        @if($ukuranList->count() > 0)
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>Filter Berdasarkan Ukuran</h4>
                            </div>
                            <div class="filter-size">
                                <form action="{{ route('shop') }}" method="GET" id="sizeFilterForm">
                                    @if(request('kategori'))
                                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    @endif
                                    @if(request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @foreach($ukuranList as $ukuran)
                                        <label class="checkbox-single">
                                            <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                                <span class="checkbox-area d-center">
                                                    <input type="radio" name="ukuran" value="{{ $ukuran }}" {{ request('ukuran') == $ukuran ? 'checked' : '' }} onchange="this.form.submit()">
                                                    <span class="checkmark d-center"></span>
                                                </span>
                                                <span class="text-color">{{ $ukuran }}</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Filter By Color -->
                        @if($warnaList->count() > 0)
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h4>Filter Berdasarkan Warna</h4>
                            </div>
                            <div class="filter-size">
                                <form action="{{ route('shop') }}" method="GET" id="colorFilterForm">
                                    @if(request('kategori'))
                                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    @endif
                                    @if(request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @foreach($warnaList as $warna)
                                        <label class="checkbox-single">
                                            <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                                <span class="checkbox-area d-center">
                                                    <input type="radio" name="warna" value="{{ $warna }}" {{ request('warna') == $warna ? 'checked' : '' }} onchange="this.form.submit()">
                                                    <span class="checkmark d-center"></span>
                                                </span>
                                                <span class="text-color">{{ $warna }}</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Products Grid -->
                <div class="col-lg-8 order-1 order-md-2">
                    <div class="woocommerce-notices-wrapper wow fadeInUp" data-wow-delay=".3s">
                        <p>Menampilkan <span>{{ $produks->firstItem() ?? 0 }}</span> - <span>{{ $produks->lastItem() ?? 0 }}</span> dari {{ $produks->total() }} Produk</p>
                        <div class="form-clt">
                            <form action="{{ route('shop') }}" method="GET" id="sortForm">
                                @if(request('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request('min_price'))
                                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                @endif
                                @if(request('max_price'))
                                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                @endif
                                <div class="nice-select" tabindex="0">
                                    <span class="current">
                                        @if(request('sort') == 'price_low')
                                            Harga: Rendah ke Tinggi
                                        @elseif(request('sort') == 'price_high')
                                            Harga: Tinggi ke Rendah
                                        @else
                                            Urutkan Terbaru
                                        @endif
                                    </span>
                                    <ul class="list">
                                        <li data-value="latest" class="option {{ !request('sort') || request('sort') == 'latest' ? 'selected focus' : '' }}" onclick="document.getElementById('sortInput').value='latest'; document.getElementById('sortForm').submit();">
                                            Urutkan Terbaru
                                        </li>
                                        <li data-value="price_low" class="option {{ request('sort') == 'price_low' ? 'selected focus' : '' }}" onclick="document.getElementById('sortInput').value='price_low'; document.getElementById('sortForm').submit();">
                                            Harga: Rendah ke Tinggi
                                        </li>
                                        <li data-value="price_high" class="option {{ request('sort') == 'price_high' ? 'selected focus' : '' }}" onclick="document.getElementById('sortInput').value='price_high'; document.getElementById('sortForm').submit();">
                                            Harga: Tinggi ke Rendah
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'latest') }}">
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        @forelse($produks as $produk)
                            <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                                <div class="shop-items style-2">
                                    <div class="shop-image">
                                        @php
                                            $gambar = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0 
                                                ? asset('produk/gambar/' . $produk->gambar_produk[0])
                                                : asset('web/assets/img/shop/01.jpg');
                                        @endphp
                                        <img src="{{ $gambar }}" alt="{{ $produk->judul }}">
                                        <ul class="product-icon d-grid justify-content-center align-items-center">
                                            <li>
                                                <a href="{{ route('shop.detail', $produk->slug) }}"><i class="far fa-eye"></i></a>
                                            </li>
                                        </ul>
                                        @if($produk->diskon > 0)
                                            <div class="offer-text">-{{ $produk->diskon }}%</div>
                                        @endif
                                    </div>
                                    <div class="shop-content">
                                        <h5><a href="{{ route('shop.detail', $produk->slug) }}">{{ $produk->judul }}</a></h5>
                                        <ul class="price-list">
                                            @if($produk->diskon > 0)
                                                @php
                                                    $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                                @endphp
                                                <li>Rp {{ number_format($hargaDiskon, 0, ',', '.') }} <del>Rp {{ number_format($produk->harga, 0, ',', '.') }}</del></li>
                                            @else
                                                <li>Rp {{ number_format($produk->harga, 0, ',', '.') }}</li>
                                            @endif
                                        </ul>
                                        @if($produk->kategori)
                                            <small class="text-muted">{{ $produk->kategori->nama_kategori ?? '' }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <p>Tidak ada produk yang tersedia saat ini.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if($produks->hasPages())
                        <div class="page-nav-wrap mt-5 text-center wow fadeInUp" data-wow-delay=".3s">
                            {{ $produks->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
<style>
    /* Force all shop images to 1:1 aspect ratio */
    .shop-image img,
    .shop-image {
        aspect-ratio: 1 / 1;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    
    .shop-image {
        overflow: hidden;
    }
</style>
@endsection