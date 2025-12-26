@extends('template_web.layout')
@section('content')

     <!--<< Breadcrumb Section Start >>-->
     <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $produk->judul }}</h1>
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
                            <a href="{{ route('shop') }}">Produk</a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            {{ $produk->judul }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Details Section Start -->
    <section class="shop-details-section section-padding">
        <div class="container">
        <div class="shop-details-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="shop-details-image">
                    <div class="tab-content">
                        @php
                            $gambars = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0 
                                ? $produk->gambar_produk 
                                : [];
                        @endphp
                        @if(count($gambars) > 0)
                            @foreach($gambars as $idx => $gambar)
                                <div id="thumb{{ $idx + 1 }}" class="tab-pane fade {{ $idx === 0 ? 'show active' : '' }}">
                                    <div class="shop-thumb">
                                        <img src="{{ asset('produk/gambar/' . $gambar) }}" alt="{{ $produk->judul }}">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div id="thumb1" class="tab-pane fade show active">
                                <div class="shop-thumb">
                                    <img src="{{ asset('web/assets/img/shop/details.jpg') }}" alt="{{ $produk->judul }}">
                                </div>
                            </div>
                        @endif
                        </div>
                        @if(count($gambars) > 1)
                            <ul class="nav mb-5">
                                @foreach($gambars as $idx => $gambar)
                                    <li class="nav-item">
                                        <a href="#thumb{{ $idx + 1 }}" data-bs-toggle="tab" class="nav-link {{ $idx === 0 ? 'ps-0 active' : '' }}">
                                            <img src="{{ asset('produk/gambar/' . $gambar) }}" alt="Thumbnail {{ $idx + 1 }}">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-details-content">
                        <h2 class="pb-3">{{ $produk->judul }}</h2>
                        <div class="star pb-3">
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                        </div>
                        <p class="mb-3">
                            {{ \Illuminate\Support\Str::limit($produk->deskripsi, 200) }}
                        </p>
                        <div class="price-list">
                            @if($produk->diskon > 0)
                                @php
                                    $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                @endphp
                                <h3>Rp {{ number_format($hargaDiskon, 0, ',', '.') }} <del style="font-size: 0.7em; color: #999;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</del></h3>
                                <span class="badge bg-danger">Diskon {{ $produk->diskon }}%</span>
                            @else
                                <h3>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                            @endif
                        </div>
                        <div class="cart-wrp">
                            <div class="cart-quantity">
                                <form id='myform' method='POST' class='quantity' action='#'>
                                    <input type='button' value='-' class='qtyminus minus'>
                                    <input type='text' name='quantity' value='1' class='qty' id='quantity'>
                                    <input type='button' value='+' class='qtyplus plus'>
                                </form>
                            </div>
                        </div>
                        <div class="shop-btn">
                            @auth
                                <button type="button" id="addToCartBtn" class="theme-btn" data-produk-id="{{ $produk->id }}">
                                    <i class="fas fa-shopping-cart"></i> <span>Masukkan Keranjang</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="theme-btn">
                                    <i class="fas fa-shopping-cart"></i> <span>Masukkan Keranjang</span>
                                </a>
                            @endauth
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="single-tab">
                <ul class="nav mb-5">
                    <li class="nav-item">
                    <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active">
                        <h6>Deskripsi</h6>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="#additional" data-bs-toggle="tab" class="nav-link">
                        <h6>Informasi Tambahan</h6>
                    </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
                    <div class="description-items">
                        <div class="description-content">
                            <h3>Deskripsi Produk</h3>
                            <p class="mb-4">
                                {!! nl2br(e($produk->deskripsi)) !!}
                            </p>
                            <div class="description-list-items d-flex justify-content-between">
                                <ul class="description-list">
                                    @if($produk->berat)
                                    <li>
                                        Berat:
                                        <span>{{ $produk->berat }} kg</span>
                                    </li>
                                    @endif
                                    @if($produk->ukuran)
                                    <li>
                                        Ukuran:
                                        <span>{{ $produk->ukuran }}</span>
                                    </li>
                                    @endif
                                    @if($produk->warna)
                                    <li>
                                        Warna:
                                        <span>{{ $produk->warna }}</span>
                                    </li>
                                    @endif
                                </ul>
                              
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="additional" class="tab-pane fade">
                    <div class="table-responsive mb-15">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>SKU</td>
                                    <td>{{ $produk->sku }}</td>
                                </tr>
                                @if($produk->berat)
                                <tr>
                                    <td>Berat</td>
                                    <td>{{ $produk->berat }} kg</td>
                                </tr>
                                @endif
                                @if($produk->ukuran)
                                <tr>
                                    <td>Ukuran</td>
                                    <td>{{ $produk->ukuran }}</td>
                                </tr>
                                @endif
                                @if($produk->warna)
                                <tr>
                                    <td>Warna</td>
                                    <td>{{ $produk->warna }}</td>
                                </tr>
                                @endif
                                @if($produk->kategori)
                                <tr>
                                    <td>Kategori</td>
                                    <td>{{ $produk->kategori->nama_kategori }}</td>
                                </tr>
                                @endif
                                @if($produk->subKategori)
                                <tr>
                                    <td>Sub Kategori</td>
                                    <td>{{ $produk->subKategori->first_nama_sub_kategori ?? '' }} {{ $produk->subKategori->second_nama_sub_kategori ?? '' }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Harga</td>
                                    <td>
                                        @if($produk->diskon > 0)
                                            @php
                                                $hargaDiskon = $produk->harga - ($produk->harga * $produk->diskon / 100);
                                            @endphp
                                            Rp {{ number_format($hargaDiskon, 0, ',', '.') }} 
                                            <del style="color: #999;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</del>
                                            <span class="badge bg-danger">Diskon {{ $produk->diskon }}%</span>
                                        @else
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <!-- Product Section Start -->
    <section class="product-section fix section-padding pt-0">
        <div class="container">
            <div class="section-title text-center">
                <div class="sub-title wow fadeInUp">
                    <span>Produk Kami</span>
                </div>
                <h2 class="wow fadeInUp" data-wow-delay=".3s">
                    Produk Terkait
                </h2>
            </div>
            @if($relatedProduks->count() > 0)
                <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        @foreach($relatedProduks as $relatedProduk)
                            <div class="swiper-slide">
                                <div class="products-box-items">
                                    <ul class="product-top">
                                        <li>{{ $relatedProduk->kategori->nama_kategori ?? 'Produk' }}</li>
                                        <li>Rp {{ number_format($relatedProduk->harga, 0, ',', '.') }}</li>
                                    </ul>
                                    <div class="product-thumb">
                                        @php
                                            $gambar = is_array($relatedProduk->gambar_produk) && count($relatedProduk->gambar_produk) > 0 
                                                ? asset('produk/gambar/' . $relatedProduk->gambar_produk[0])
                                                : asset('web/assets/img/product/p-1.jpg');
                                        @endphp
                                        <img src="{{ $gambar }}" alt="{{ $relatedProduk->judul }}">
                                        <ul class="product-icon d-grid justify-content-center align-items-center">
                                            <li>
                                                <a href="{{ route('shop.detail', $relatedProduk->slug) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                            @php
                                                $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                                $pesan = "Halo, saya tertarik dengan produk: " . $relatedProduk->judul;
                                                $waLink = "https://wa.me/" . $no_wa_clean . "?text=" . urlencode($pesan);
                                            @endphp
                                            <a href="{{ $waLink }}" target="_blank" class="theme-btn" style="background-color:#25D366; border: none; color:#fff;">
                                                <i class="fab fa-whatsapp"></i> Pesan
                                            </a>
                                        @else
                                            <a href="{{ route('shop.detail', $relatedProduk->slug) }}" class="theme-btn">Lihat Detail</a>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="{{ route('shop.detail', $relatedProduk->slug) }}">{{ $relatedProduk->judul }}</a></h4>
                                        <div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-dot mt-2">
                        <div class="dot"></div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <p>Tidak ada produk terkait yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>

@endsection

@section('style')
<style>
    /* Force all product detail images to 1:1 aspect ratio */
    .shop-thumb img,
    .shop-details-image .nav-link img,
    .product-thumb img {
        aspect-ratio: 1 / 1;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    
    .shop-thumb,
    .shop-details-image .nav-link,
    .product-thumb {
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }
    
    /* Thumbnail navigation */
    .shop-details-image .nav-link {
        display: block;
    }
</style>
@endsection

@section('script')
<script>
    // Quantity Button Handler
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInput = document.querySelector('.qty');
        const qtyMinus = document.querySelector('.qtyminus');
        const qtyPlus = document.querySelector('.qtyplus');
        
        if (qtyMinus && qtyPlus && qtyInput) {
            qtyMinus.addEventListener('click', function() {
                let currentVal = parseInt(qtyInput.value) || 1;
                if (currentVal > 1) {
                    qtyInput.value = currentVal - 1;
                }
            });
            
            qtyPlus.addEventListener('click', function() {
                let currentVal = parseInt(qtyInput.value) || 1;
                qtyInput.value = currentVal + 1;
            });
        }

        // Add to Cart Handler
        const addToCartBtn = document.getElementById('addToCartBtn');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function() {
                const produkId = this.getAttribute('data-produk-id');
                const quantity = parseInt(document.getElementById('quantity').value) || 1;
                
                // Disable button
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menambahkan...</span>';

                fetch('{{ route("keranjang.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        produk_id: produkId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message || 'Produk berhasil ditambahkan ke keranjang',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Reload halaman setelah SweetAlert selesai
                            location.reload();
                        });
                        // Reload cart sidebar
                        if (typeof loadCart === 'function') {
                            loadCart();
                        }
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message || 'Gagal menambahkan produk ke keranjang',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menambahkan produk ke keranjang',
                        icon: 'error'
                    });
                })
                .finally(() => {
                    // Re-enable button
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-shopping-cart"></i> <span>Masukkan Keranjang</span>';
                });
            });
        }
    });
</script>
@endsection