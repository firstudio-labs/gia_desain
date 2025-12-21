<footer class="footer-section section-bg">
    <div class="container">
        <div class="footer-widgets-wrapper">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <a href="{{ route('landing') }}">
                                @if($profil && $profil->logo_perusahaan)
                                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="{{ $profil->nama_perusahaan ?? 'Logo' }}" style="max-height: 50px;">
                                @else
                                    <img src="{{ asset('web') }}/assets/img/logo/logo.svg" alt="logo-img">
                                @endif
                            </a>
                        </div>
                        <div class="footer-content">
                            <p>
                                @if($profil && $profil->alamat_perusahaan)
                                    {{ $profil->alamat_perusahaan }}
                                @else
                                    Kami menghadirkan solusi percetakan yang praktis dan hasil terbaik untuk kebutuhan Anda.
                                @endif
                            </p>
                            <div class="social-icon style-2 d-flex align-items-center">
                                @if($profil && $profil->facebook_perusahaan)
                                    <a href="{{ $profil->facebook_perusahaan }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($profil && $profil->twitter_perusahaan)
                                    <a href="{{ $profil->twitter_perusahaan }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($profil && $profil->instagram_perusahaan)
                                    <a href="{{ $profil->instagram_perusahaan }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($profil && $profil->linkedin_perusahaan)
                                    <a href="{{ $profil->linkedin_perusahaan }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Link Penting</h3>
                        </div>
                        <ul class="list-items">
                            <li>
                                <a href="{{ route('about') }}">
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('layanan') }}">
                                    Layanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shop') }}">
                                    Toko
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kontak.index') }}">
                                    Kontak
                                </a>
                            </li>
                            @auth
                            <li>
                                <a href="{{ route('riwayat-pesanan.index') }}">
                                    Riwayat Pesanan
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Kontak Kami</h3>
                        </div>
                        <ul class="contact-list-2">
                            @if($profil && $profil->no_telp_perusahaan)
                            <li>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                        viewBox="0 0 21 21" fill="none">
                                        <g clip-path="url(#clip0_15_32)">
                                            <path
                                                d="M16.5059 20.75C15.6931 20.5298 14.8643 20.3536 14.0635 20.0854C11.4289 19.2005 9.07861 17.8071 6.99658 15.9693C4.62226 13.8753 2.78047 11.3889 1.50723 8.48203C0.986719 7.28887 0.582324 6.05967 0.310059 4.78242C0.290039 4.68633 0.27002 4.58623 0.25 4.49014C0.25 4.2499 0.25 4.00967 0.25 3.76943C0.262012 3.72539 0.282031 3.68135 0.290039 3.6373C0.454199 2.59229 0.962695 1.74746 1.85557 1.1709C2.47217 0.774512 3.1248 0.422168 3.85351 0.25C4.01367 0.25 4.17383 0.25 4.33398 0.25C4.56621 0.330078 4.80644 0.390137 5.02266 0.494238C5.38701 0.666406 5.64726 0.962695 5.85547 1.30703C6.42803 2.25996 7.00459 3.21289 7.57314 4.16982C8.19775 5.21484 7.90146 6.39199 6.86045 7.02461C6.64023 7.16074 6.41601 7.29287 6.1918 7.425C5.83945 7.63721 5.79541 7.77334 5.95156 8.14971C6.84443 10.2437 8.21377 11.9694 9.99951 13.3708C10.8884 14.0715 11.8573 14.64 12.9063 15.0725C13.2106 15.1966 13.3668 15.1485 13.543 14.8643C13.7191 14.576 13.8873 14.2757 14.0755 13.9954C14.616 13.1786 15.7291 12.8383 16.5819 13.3067C17.711 13.9313 18.8081 14.616 19.9092 15.2967C20.3656 15.581 20.6099 16.0334 20.714 16.5579C20.722 16.5939 20.742 16.63 20.754 16.666C20.754 16.8262 20.754 16.9863 20.754 17.1465C20.71 17.3066 20.6819 17.4748 20.6139 17.6229C20.4217 18.0394 20.2255 18.4558 20.0093 18.8602C19.6009 19.6289 18.9803 20.1814 18.1675 20.4937C17.8672 20.6099 17.5429 20.6659 17.2306 20.75C16.9863 20.75 16.7461 20.75 16.5059 20.75ZM6.1918 6.48809C6.2999 6.42402 6.38799 6.37598 6.47207 6.32393C7.10469 5.92754 7.28086 5.25488 6.90049 4.61025C6.31992 3.62129 5.72734 2.64033 5.13076 1.65938C4.77441 1.07881 4.1498 0.898633 3.5332 1.18691C3.18486 1.35107 2.83652 1.52324 2.5002 1.70742C1.41914 2.304 0.85459 3.54121 1.11885 4.74639C1.42314 6.13975 1.88359 7.48105 2.52021 8.7543C5.2709 14.2517 9.56308 17.9393 15.4809 19.685C16.0694 19.8571 16.662 20.0173 17.2906 19.9052C18.1314 19.753 18.7721 19.3166 19.2405 18.5799C17.5148 17.5469 15.8052 16.5179 14.0915 15.4889C13.615 15.9934 13.0865 16.0254 12.4779 15.7611C10.8684 15.0604 9.45098 14.0795 8.20976 12.8463C6.90449 11.549 5.87148 10.0636 5.1708 8.35391C4.95459 7.82539 5.04668 7.36494 5.45107 6.96055C5.46709 6.94453 5.4831 6.92051 5.50312 6.89648C5.46709 6.83643 5.43506 6.77637 5.39902 6.72031C4.8625 5.82344 4.32197 4.92656 3.78545 4.02969C3.74541 3.96162 3.70137 3.89355 3.67334 3.81748C3.60127 3.62529 3.66934 3.4291 3.8375 3.33301C4.00166 3.23691 4.20986 3.27295 4.34199 3.4291C4.39004 3.48516 4.42607 3.54922 4.46611 3.60928C4.81045 4.18184 5.15478 4.75039 5.49512 5.32295C5.72334 5.70732 5.95156 6.0917 6.1918 6.48809ZM19.6129 17.8672C19.6729 17.7511 19.725 17.651 19.777 17.5509C20.1254 16.8502 19.9412 16.2256 19.2726 15.8252C18.3316 15.2606 17.3907 14.6921 16.4458 14.1315C16.3217 14.0555 16.1855 13.9874 16.0494 13.9514C15.4088 13.7792 14.8242 14.1155 14.5319 14.8202C16.2136 15.8292 17.9032 16.8462 19.6129 17.8672Z"
                                                fill="white" />
                                            <path
                                                d="M3.54648 2.34416C3.54248 2.56437 3.36631 2.73654 3.1501 2.73254C2.93389 2.72853 2.76172 2.54836 2.76172 2.33215C2.76572 2.11593 2.9499 1.93576 3.15811 1.93976C3.37031 1.94377 3.54648 2.12795 3.54648 2.34416Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_15_32">
                                                <rect width="20.5" height="20.5" fill="white"
                                                    transform="translate(0.25 0.25)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="content">
                                    <span>Telepon</span>
                                    <h3><a href="tel:{{ $profil->no_telp_perusahaan }}">{{ $profil->no_telp_perusahaan }}</a></h3>
                                </div>
                            </li>
                            @endif
                            @if($profil && $profil->email_perusahaan)
                            <li>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                        viewBox="0 0 21 21" fill="none">
                                        <g clip-path="url(#clip0_15_42)">
                                            <path
                                                d="M18.9482 3.29297H2.05176C1.06031 3.29297 0.25 4.09972 0.25 5.09473V15.9053C0.25 16.9006 1.06083 17.707 2.05176 17.707H18.9482C19.9397 17.707 20.75 16.9003 20.75 15.9053V5.09473C20.75 4.09948 19.9393 3.29297 18.9482 3.29297ZM18.6716 4.49414C18.089 5.07859 11.2465 11.9434 10.9654 12.2254C10.7306 12.461 10.2695 12.4611 10.0346 12.2254L2.32843 4.49414H18.6716ZM1.45117 15.6845V5.31554L6.61881 10.5L1.45117 15.6845ZM2.32843 16.5059L7.4668 11.3507L9.18388 13.0734C9.88752 13.7794 11.1128 13.7791 11.8162 13.0734L13.5332 11.3508L18.6716 16.5059H2.32843ZM19.5488 15.6845L14.3812 10.5L19.5488 5.31554V15.6845Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_15_42">
                                                <rect width="20.5" height="20.5" fill="white"
                                                    transform="translate(0.25 0.25)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="content">
                                    <span>Email</span>
                                    <h3> <a href="mailto:{{ $profil->email_perusahaan }}"
                                            class="link">{{ $profil->email_perusahaan }}</a></h3>
                                </div>
                            </li>
                            @endif
                            <li>
                                <div class="">
                                        <img src="https://assets.zonalogo.com/finance/bank-central-asia/bank-central-asia-256.webp" alt="Logo Bank" style="max-width: 40px; height: auto;">

                                </div>
                                <div class="content">
                                    <span>Rekening Bank</span>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <div>
                                            <h3 class="mb-0" style="font-size: 14px; font-weight: 600;">2521318025</h3>
                                            <small style="font-size: 12px; opacity: 0.8;">Imam Rizki</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                          
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-6 col-lg-4 ps-lg-5 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single-footer-widget">
                        <div class="widget-head">
                            <h3>Layanan Kami</h3>
                        </div>
                        <ul class="list-items">
                            <li>
                                <a href="{{ route('layanan') }}">
                                    Semua Layanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('shop') }}">
                                    Produk Kami
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}">
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kontak.index') }}">
                                    Hubungi Kami
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-wrapper justify-content-center">
                <p class="wow fadeInUp" data-wow-delay=".3s">
                    Copyright {{ date('Y') }} © 
                    @if($profil && $profil->nama_perusahaan)
                        {{ $profil->nama_perusahaan }}
                    @else
                        Perusahaan
                    @endif
                    . All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
