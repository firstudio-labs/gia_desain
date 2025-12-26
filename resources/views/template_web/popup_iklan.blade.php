@if($manageInfos && $manageInfos->count() > 0)
    <div class="modal fade popup-iklan-modal" id="popupIklan" tabindex="-1" aria-labelledby="popupIklanLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content popup-iklan-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div id="popupIklanCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach($manageInfos as $index => $info)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="popup-iklan-slide d-flex align-items-center justify-content-center p-0" style="aspect-ratio: 1 / 1; width: 100%; background: transparent; overflow: hidden;">
                                        @if($info->gambar)
                                            <img src="{{ asset('info/gambar/' . $info->gambar) }}" alt="{{ $info->judul }}" class="w-100 h-100" style="object-fit: cover; aspect-ratio: 1 / 1; display: block;">
                                        @endif
                                        <div class="popup-iklan-overlay" style="position: absolute; inset: 0;">
                                            <div class="popup-iklan-content-inner">
                                                <h5 class="popup-iklan-title">{{ $info->judul }}</h5>
                                                @if($info->deskripsi)
                                                    <div class="popup-iklan-description">
                                                        <p class="mb-0">{!! nl2br(e($info->deskripsi)) !!}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($manageInfos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#popupIklanCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#popupIklanCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            <div class="carousel-indicators">
                                @foreach($manageInfos as $index => $info)
                                    <button type="button" data-bs-target="#popupIklanCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
             
            </div>
        </div>
    </div>
@endif

<style>
    .popup-iklan-modal {
        z-index: 1055;
    }

    .popup-iklan-modal .modal-dialog {
        max-width: 350px;
        margin: 1rem auto;
    }

    .popup-iklan-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        border: none;
        max-height: 90vh;
        overflow-y: auto;
    }

    /* Pastikan body tetap bisa di-scroll */
    body.modal-open {
        overflow: hidden !important;
        padding-right: 0 !important;
    }

    /* Pastikan backdrop tidak menutupi seluruh layar */
    .popup-iklan-modal .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1050;
    }

    .popup-iklan-modal .modal-header {
        background: transparent;
        padding: 0.5rem 0.5rem 0;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 10;
        border: none;
    }

    .popup-iklan-modal .btn-close {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        opacity: 1;
        padding: 0.4rem;
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }

    .popup-iklan-modal .btn-close:hover {
        background: rgba(255, 255, 255, 1);
    }

    .popup-iklan-slide {
        width: 100%;
        height: 300px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        border-radius: 15px 15px 0 0;
    }

    .popup-iklan-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0;
    }

    .popup-iklan-content-inner {
        width: 100%;
        color: white;
        text-align: center;
    }

    .popup-iklan-title {
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .popup-iklan-description {
        color: #fff;
        line-height: 1.4;
        font-size: 0.85rem;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .popup-iklan-modal .modal-footer {
        padding: 0.75rem;
        background: #fff;
    }

    .popup-iklan-modal .modal-footer .btn {
        min-width: 80px;
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .popup-iklan-modal .carousel-control-prev,
    .popup-iklan-modal .carousel-control-next {
        width: 30px;
        height: 30px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        opacity: 0.8;
    }

    .popup-iklan-modal .carousel-control-prev {
        left: 10px;
    }

    .popup-iklan-modal .carousel-control-next {
        right: 10px;
    }

    .popup-iklan-modal .carousel-control-prev-icon,
    .popup-iklan-modal .carousel-control-next-icon {
        width: 15px;
        height: 15px;
    }

    .popup-iklan-modal .carousel-indicators {
        margin-bottom: 0.5rem;
    }

    .popup-iklan-modal .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
    }

    .popup-iklan-modal .carousel-indicators button.active {
        background-color: rgba(255, 255, 255, 1);
    }

    @media (max-width: 576px) {
        .popup-iklan-modal .modal-dialog {
            max-width: 300px;
            margin: 1rem auto;
        }

        .popup-iklan-slide {
            height: 250px;
        }

        .popup-iklan-title {
            font-size: 0.9rem;
        }

        .popup-iklan-description {
            font-size: 0.75rem;
        }
    }

    /* Pastikan modal tidak full screen dan body tetap bisa di-scroll */
    html:not(.modal-open) {
        overflow-y: auto !important;
    }

    body:not(.modal-open) {
        overflow-y: auto !important;
        padding-right: 0 !important;
    }
</style>

<script>
    // Fungsi untuk memastikan body bisa di-scroll
    function enableBodyScroll() {
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        document.body.classList.remove('modal-open');
        // Hapus semua backdrop yang mungkin masih ada
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
    }

    // Fungsi untuk menampilkan popup iklan
    function showPopupIklan() {
        const popupModal = document.getElementById('popupIklan');
        
        if (popupModal) {
            // Hapus instance modal yang mungkin masih ada
            const existingInstance = bootstrap.Modal.getInstance(popupModal);
            if (existingInstance) {
                existingInstance.dispose();
            }
            
            // Reset carousel ke slide pertama
            const carousel = popupModal.querySelector('#popupIklanCarousel');
            if (carousel) {
                const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                if (carouselInstance) {
                    carouselInstance.to(0);
                }
            }
            
            // Buat instance baru dan tampilkan
            const modalInstance = new bootstrap.Modal(popupModal, {
                backdrop: 'static',
                keyboard: false
            });
            
            // Event listener untuk saat modal ditutup
            popupModal.addEventListener('hidden.bs.modal', function() {
                enableBodyScroll();
            });

            // Event listener untuk tombol close
            const closeButtons = popupModal.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(function() {
                        enableBodyScroll();
                    }, 100);
                });
            });
            
            // Delay sedikit untuk memastikan halaman sudah ter-render
            setTimeout(function() {
                modalInstance.show();
            }, 800);
        }
    }

    // Tampilkan popup saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        showPopupIklan();
    });

    // Tampilkan popup saat halaman selesai dimuat (fallback)
    window.addEventListener('load', function() {
        // Cek apakah modal sudah ditampilkan
        const activeModal = document.querySelector('.popup-iklan-modal.show');
        if (!activeModal) {
            setTimeout(function() {
                showPopupIklan();
            }, 500);
        }
    });

    // Deteksi saat user kembali ke halaman (back/forward browser)
    window.addEventListener('pageshow', function(event) {
        // Jika halaman dimuat dari cache (back/forward)
        if (event.persisted) {
            enableBodyScroll();
            setTimeout(function() {
                showPopupIklan();
            }, 500);
        }
    });

    // Deteksi perubahan URL untuk aplikasi SPA (jika ada)
    let lastUrl = location.href;
    new MutationObserver(function() {
        const url = location.href;
        if (url !== lastUrl) {
            lastUrl = url;
            enableBodyScroll();
            setTimeout(function() {
                showPopupIklan();
            }, 500);
        }
    }).observe(document, { subtree: true, childList: true });

    // Pastikan body bisa di-scroll saat halaman dimuat
    window.addEventListener('load', function() {
        setTimeout(function() {
            enableBodyScroll();
        }, 100);
    });
</script>

