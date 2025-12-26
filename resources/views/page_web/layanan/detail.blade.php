@extends('template_web.layout')
@section('content')
    
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/breadcrumb.png');">
        <div class="container">
            <div class="page-heading">
                <div class="breadcrumb-sub-title text-center">
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">{{ $manageLayanan->judul_layanan }}</h1>
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                        <li>
                            <a href="{{ route('landing') }}">
                            Home
                            </a>
                        </li>
                        <li>
                            <i class="fal fa-minus"></i>
                        </li>
                        <li>
                            {{ $manageLayanan->judul_layanan }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

     <!-- service Section Start -->
     <section class="service-details-section fix section-padding section-bg-2">
        <div class="container">
           <div class="service-details-wrapper">
               <div class="row g-5">
                   <div class="col-lg-8">
                       @if($manageLayanan->gambar_layanan)
                       <div class="service-details-image" style="max-width: 600px; margin:0 auto;">
                           <img src="{{ asset('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan) }}" alt="{{ $manageLayanan->judul_layanan }}" class="img-fluid" style="max-width:100%;">
                       </div>
                       @endif
                       <div class="service-details-content">
                           <h3>{{ $manageLayanan->judul_layanan }}</h3>
                           <p class="mt-3">
                                {!! nl2br(e($manageLayanan->deskripsi_layanan)) !!}
                            </p>
                            @if($manageLayanan->faq && count($manageLayanan->faq) > 0)
                            <h3 class="mt-5 mb-4">Frequently Asked Questions</h3>
                            <div class="faq-wrapper">
                                <div class="faq-content style-2">
                                    <div class="faq-accordion">
                                        <div class="accordion" id="accordion">
                                            @foreach($manageLayanan->faq as $index => $faq)
                                                <div class="accordion-item mb-4 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 0.2 }}s">
                                                    <h5 class="accordion-header">
                                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $loop->iteration }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faq{{ $loop->iteration }}">
                                                           <span>{{ $loop->iteration }}.</span> {{ $faq['pertanyaan'] }}
                                                        </button>
                                                    </h5>
                                                    <div id="faq{{ $loop->iteration }}" class="accordion-collapse {{ $loop->first ? 'show' : 'collapse' }}" data-bs-parent="#accordion">
                                                        <div class="accordion-body">
                                                            {!! nl2br(e($faq['jawaban'])) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                       </div>
                   </div>
                    <div class="col-lg-4">
                        <div class="service-sidebar">
                            <div class="service-widget-categories">
                                <h4>Service Offer</h4>
                                <ul>
                                    @foreach($manageLayanans as $manageLayanan)
                                        <li><a href="{{ route('layanan.detail', $manageLayanan->judul_layanan) }}">{{ $manageLayanan->judul_layanan }}</a> <span><i class="far fa-long-arrow-right"></i></span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="contact-bg text-center bg-cover" style="background-image: url('https://i.pinimg.com/originals/ac/5e/66/ac5e66a718a3a5254a4f7575815c168c.png');">
                                <div class="mb-3">
                                    <i class="fab fa-whatsapp" style="color:#25D366; font-size: 3rem; background: white; border-radius: 50%; padding: 18px 18px;"></i>
                                </div>
                                <h3 class="text-dark fw-bold">
                                    Butuh Bantuan? <br>
                                    Hubungi Kami <br>
                                    Sekarang
                                </h3>
                                <p class="text-dark">Chat via WhatsApp</p>
                                <p class="text-dark">Hubungi Kami Sekarang</p>
                                @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                                    @php
                                        // Format nomor untuk wa.me (hapus +, spasi, dan tanda -)
                                        $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                                    @endphp
                                    <a href="https://wa.me/{{ $no_wa_clean }}" target="_blank" class="theme-btn w-100" style="background-color:#25D366; border: none; color:#fff;">
                                        <i class="fab fa-whatsapp" style="color:#fff;"></i> {{ $ownerWhatsapp->no_wa }}
                                    </a>
                                @else
                                    <a href="#" class="theme-btn w-100" style="background-color:#25D366; border: none; color:#fff;">
                                        <i class="fab fa-whatsapp" style="color:#fff;"></i> Hubungi Kami
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
               </div>
           </div>
        </div>
    </section>
   
    <!-- Cta Section Start -->
    <section class="cta-section-3">
        <div class="container">
            <div class="cta-wrapper-3 bg-cover" style="background-image: url('{{ asset('web') }}/assets/img/cta-bg-3.jpg');">
                <div class="cta-content">
                    <h2 class="split-text right">
                        Siap Membuat <br>
                        Produk Kustom <br>
                        Impian Anda?
                    </h2>
                    @if(isset($ownerWhatsapp) && $ownerWhatsapp->no_wa)
                        @php
                            // Format nomor untuk wa.me (hapus +, spasi, dan tanda -)
                            $no_wa_clean = preg_replace('/[^0-9]/', '', $ownerWhatsapp->no_wa);
                        @endphp
                        <a href="https://wa.me/{{ $no_wa_clean }}" target="_blank" class="theme-btn wow fadeInUp" data-wow-delay=".5s" style="background-color:#25D366; border: none; color:#fff;">
                            <i class="fab fa-whatsapp"></i> Hubungi Kami Sekarang
                        </a>
                    @else
                        <a href="#" class="theme-btn wow fadeInUp" data-wow-delay=".5s" style="background-color:#25D366; border: none; color:#fff;">
                            <i class="fab fa-whatsapp"></i> Hubungi Kami Sekarang
                        </a>
                    @endif
                </div>
                <div class="cta-shape wow fadeInUp" data-wow-delay=".3s"> 
                    @if(isset($manageLayanan) && $manageLayanan->gambar_layanan)
                        <img src="{{ asset('gambar_layanan/gambar/' . $manageLayanan->gambar_layanan) }}" alt="{{ $manageLayanan->judul_layanan }}">
                    @else
                        <img src="{{ asset('web/assets/img/cta-2-shape2.png') }}" alt="img">
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
<style>
    /* Force all images to 1:1 aspect ratio */
    .service-details-image img,
    .shop-thumb img,
    .shop-details-image .nav-link img,
    .cta-shape img,
    .product-thumb img {
        aspect-ratio: 1 / 1;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    
    .service-details-image,
    .shop-thumb,
    .shop-details-image .nav-link,
    .cta-shape,
    .product-thumb {
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }
</style>
@endsection