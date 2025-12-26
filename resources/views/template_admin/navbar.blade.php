<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/dashboard-superadmin" class="b-brand text-primary d-flex align-items-center" style="gap: 10px;">
                @php
                    $profil = \App\Models\Profil::first();
                @endphp
                @if($profil && $profil->logo_perusahaan)
                    <img src="{{ asset('upload/profil/' . $profil->logo_perusahaan) }}" alt="Logo" style="height: 50px;">
                @else
                    <img src="{{ asset('env/logo.png') }}" alt="Logo" style="height: 50px;">
                @endif
              
            </a>
        </div>
        @if (Auth::user()->role == 'superadmin')
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="/dashboard-superadmin" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-home"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Data Admin</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                 
                    <li class="pc-item">
                        <a href="{{ route('profil-perusahaan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-building"></i></span>
                            <span class="pc-mtext">Profil Perusahaan</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('beranda.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-home"></i></span>
                            <span class="pc-mtext">Beranda</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('manage-layanan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-list-check"></i></span>
                            <span class="pc-mtext">Data Layanan</span>
                        </a>
                    </li>

                    <li class="pc-item pc-hasmenu">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-menu"></i></span>
                            <span class="pc-mtext">Manage Kategori</span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a href="{{ route('manage-kategori.index') }}" class="pc-link">
                                    <span class="pc-mtext">Data Kategori</span>
                                </a>
                            </li>
                            <li class="pc-item">
                                <a href="{{ route('manage-sub-kategori.index') }}" class="pc-link">
                                    <span class="pc-mtext">Data Sub Kategori</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('manage-produk.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="pc-mtext">Manage Produk</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-section.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-layout-grid"></i></span>
                            <span class="pc-mtext">Manage Section</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-info.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-info-circle"></i></span>
                            <span class="pc-mtext">Manage Info</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('manage-artikel.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-text"></i></span>
                            <span class="pc-mtext">Manage Artikel</span>
                        </a>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brand-whatsapp"></i></span>
                            <span class="pc-mtext">WhatsApp Management</span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a href="{{ route('owner-whatsapp.index') }}" class="pc-link">
                                    <span class="pc-mtext">Owner WhatsApp</span>
                                </a>
                            </li>
                            <li class="pc-item">
                                <a href="{{ route('whatsapp-api.index') }}" class="pc-link">
                                    <span class="pc-mtext">Whatsapp API</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('daftar-riwayat-pesanan.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="pc-mtext">Daftar Riwayat Pesanan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('daftar-user.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Daftar User</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
