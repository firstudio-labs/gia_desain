<div id="targetElement" class="side_bar slideInRight side_bar_hidden">
        <div class="side_bar_overlay"></div>
        <div class="cart-title mb-50">
            <h4>Keranjang Belanja</h4>
        </div>
        <div class="cartmini__widget" id="cartItems">
            <div class="text-center py-5">
                <p class="text-muted">Memuat keranjang...</p>
            </div>
        </div>
        <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
    </div>

<style>
    /* Force all cart images to 1:1 aspect ratio */
    .cartmini__thumb img,
    .cartmini__thumb a {
        aspect-ratio: 1 / 1;
        object-fit: cover;
        width: 100%;
        height: 100%;
        display: block;
    }
    
    .cartmini__thumb {
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }
</style>

<script>
    function loadCart() {
        fetch('{{ route("keranjang.get") }}', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            const cartItems = document.getElementById('cartItems');
            
            if (data.items && data.items.length > 0) {
                let html = '';
                
                data.items.forEach(item => {
                    html += `
                        <div class="cartmini__widget-item" data-cart-id="${item.id}">
                            <div class="cartmini__thumb">
                                <a href="{{ url('/shop') }}/${item.slug}">
                                    <img src="${item.gambar}" alt="${item.judul}" style="aspect-ratio: 1/1; object-fit: cover; width: 100%; height: 100%;">
                                </a>
                            </div>
                            <div class="cartmini__content">
                                <h5><a href="{{ url('/shop') }}/${item.slug}">${item.judul}</a></h5>
                                <div class="cartmini__price-wrapper">
                                    <span class="cartmini__price">Rp ${formatNumber(item.harga)}</span>
                                    <span class="cartmini__quantity">x${item.quantity}</span>
                                </div>
                            </div>
                            <button class="cartmini__del" onclick="removeFromCart(${item.id})">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>
                    `;
                });
                
                html += `
                    <div class="cartmini__checkout">
                        <div class="cartmini__checkout-title mb-4">
                            <h4>Subtotal:</h4>
                            <span>Rp ${formatNumber(data.subtotal)}</span>
                        </div>
                        <div class="cartmini__checkout-btn">
                            <a href="#" class="theme-btn mb-2 w-100" onclick="event.preventDefault(); window.location.href='{{ route('shop') }}'">Lihat Semua Produk</a>
                            <a href="#" class="theme-btn w-100 style-2" onclick="lanjutkanPesanan()">Lanjutkan Pesanan</a>
                        </div>
                    </div>
                `;
                
                cartItems.innerHTML = html;
            } else {
                cartItems.innerHTML = `
                    <div class="text-center py-5">
                        <p class="text-muted">Keranjang Anda kosong</p>
                        <a href="{{ route('shop') }}" class="theme-btn mt-3">Mulai Belanja</a>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading cart:', error);
            document.getElementById('cartItems').innerHTML = `
                <div class="text-center py-5">
                    <p class="text-danger">Gagal memuat keranjang</p>
                </div>
            `;
        });
    }

    function removeFromCart(cartId) {
        Swal.fire({
            title: 'Hapus Produk?',
            text: 'Apakah Anda yakin ingin menghapus produk ini dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('/keranjang') }}/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message || 'Produk berhasil dihapus dari keranjang',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        loadCart();
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.message || 'Gagal menghapus produk dari keranjang',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus produk',
                        icon: 'error'
                    });
                });
            }
        });
    }

    function lanjutkanPesanan() {
        @auth
            // Redirect ke halaman checkout
            window.location.href = '{{ route("pesanan.checkout") }}';
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Load cart on page load and when sidebar opens
    document.addEventListener('DOMContentLoaded', function() {
        loadCart();
        
        // Reload cart when sidebar opens
        const openButton = document.getElementById('openButton');
        if (openButton) {
            openButton.addEventListener('click', function() {
                setTimeout(loadCart, 100); // Small delay to ensure sidebar is visible
            });
        }
    });
</script>