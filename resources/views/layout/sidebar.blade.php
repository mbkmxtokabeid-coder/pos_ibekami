<!-- ========== App Menu (SHADCN MODERN DARK SIDEBAR - IBEKAMI) ========== -->
<div class="app-menu navbar-menu shadcn-sidebar">
    <!-- TOP: Organization / Brand Header -->
    <div class="sidebar-org-box">
        <div class="dropdown w-100">
            <button type="button" class="btn org-trigger-btn d-flex align-items-center w-100" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="org-avatar-badge">
                    <img src="{{ asset('images/Ibekami.png') }}" 
                         alt="Ibekami Logo" 
                         class="org-avatar-img" 
                         onerror="this.onerror=null;this.src='{{ asset('images/ibekamiputih.png') }}';">
                </div>
                <div class="org-info">
                    <div class="text-start overflow-hidden">
                        <span class="org-name text-truncate d-block">Ibekami</span>
                        <span class="org-badge-pro">INVOICE</span>
                    </div>
                    <i class="ri-expand-up-down-line org-chevron ms-auto text-muted"></i>
                </div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark shadcn-dropdown-menu shadow-lg">
                <div class="shadcn-menu-inner">
                    <div class="px-3 py-2 border-bottom border-secondary border-opacity-25">
                        <span class="text-muted text-uppercase fs-11 fw-semibold">Pintasan Navigasi</span>
                    </div>
                    <div class="p-1">
                        <a class="dropdown-item shadcn-item d-flex align-items-center gap-2" href="{{ url('/') }}">
                            <i class="las la-house-damage fs-16 text-primary"></i> Dashboard Ibekami
                        </a>
                        @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))
                        <a class="dropdown-item shadcn-item d-flex align-items-center gap-2" href="{{ route('daftar_invoice') }}">
                            <i class="ri-file-list-3-line fs-16 text-info"></i> Daftar Invoice
                        </a>
                        <a class="dropdown-item shadcn-item d-flex align-items-center gap-2" href="{{ route('user.index') }}">
                            <i class="las la-users-cog fs-16 text-warning"></i> Kelola Karyawan
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MIDDLE: Navigation Items (ScrollArea) -->
    <div id="scrollbar" class="sidebar-scroll-area">
        <div class="container-fluid p-0">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                @if (Auth::check() && ((Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik') || (Auth::user()->role == 'Produksi') || (Auth::user()->role == 'Magang')))

                @if (Auth::check() && (Auth::user()->role == 'Admin' || Auth::user()->role == 'Pemilik'))

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <span class="icon-box"><i class="ri-dashboard-3-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Dashboard</span>
                    </a>
                </li>

                <!-- Invoices Management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*invoice*') || Request::is('*Invoice*') || Request::is('invoices*') || Request::routeIs('daftar_invoice')) ? 'active' : '' }}" href="{{ route('daftar_invoice') }}">
                        <span class="icon-box"><i class="las la-file-invoice-dollar menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Invoices Management</span>
                    </a>
                </li>

                <!-- Barang -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'active' : '' }}" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'true' : 'false' }}" aria-controls="sidebarProduct">
                        <span class="icon-box"><i class="las la-boxes menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Barang</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'show' : '' }}" id="sidebarProduct" data-bs-parent="#navbar-nav">
                        <ul class="nav nav-sm flex-column sub-menu-list">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*listBarang*') || Request::is('*barang*') || Request::is('*Barang*') || Request::is('*edit-stok*') || Request::routeIs('listBarang')) ? 'active' : '' }}" href="{{ route('listBarang') }}">
                                    <i class="las la-box-open sub-menu-icon"></i> <span class="menu-text">Daftar Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*material*') || Request::is('*Material*') || Request::routeIs('listMaterial')) ? 'active' : '' }}" href="{{ route('listMaterial') }}">
                                    <i class="las la-tools sub-menu-icon"></i> <span class="menu-text">Daftar Material</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listInventaris')) ? 'active' : '' }}" href="{{ route('listInventaris') }}">
                                    <i class="las la-dolly-flatbed sub-menu-icon"></i> <span class="menu-text">Daftar Inventaris</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Pembelian -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*vendor*') || Request::is('*pembelian*') || Request::is('*Pembelian*') || Request::routeIs('vendor.*') || Request::routeIs('pembelian.*')) ? 'active' : '' }}" href="{{ route('vendor.list') }}">
                        <span class="icon-box"><i class="mdi mdi-cash-minus menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Pembelian</span>
                    </a>
                </li>

                <!-- Surat (SPB, SPK, SPJ) -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*spb*') || Request::is('*spk*') || Request::is('*spj*') || Request::routeIs('daftar-spb') || Request::routeIs('daftar-spk') || Request::routeIs('spj.*')) ? 'active' : '' }}" href="#sidebarSurat" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('*spb*') || Request::is('*spk*') || Request::is('*spj*') || Request::routeIs('daftar-spb') || Request::routeIs('daftar-spk') || Request::routeIs('spj.*')) ? 'true' : 'false' }}" aria-controls="sidebarSurat">
                        <span class="icon-box"><i class="ri-mail-open-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Surat</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (Request::is('*spb*') || Request::is('*spk*') || Request::is('*spj*') || Request::routeIs('daftar-spb') || Request::routeIs('daftar-spk') || Request::routeIs('spj.*')) ? 'show' : '' }}" id="sidebarSurat" data-bs-parent="#navbar-nav">
                        <ul class="nav nav-sm flex-column sub-menu-list">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spb*') || Request::routeIs('daftar-spb')) ? 'active' : '' }}" href="{{ route('daftar-spb') }}">
                                    <i class="ri-truck-line sub-menu-icon"></i> <span class="menu-text">SPB</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spk*') || Request::routeIs('daftar-spk')) ? 'active' : '' }}" href="{{ route('daftar-spk') }}">
                                    <i class="ri-mail-settings-line sub-menu-icon"></i> <span class="menu-text">SPK</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spj*') || Request::routeIs('spj.*')) ? 'active' : '' }}" href="{{ route('spj.index') }}">
                                    <i class="ri-mail-send-line sub-menu-icon"></i> <span class="menu-text">SPJ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Laporan -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*laporan*') || Request::is('*Laporan*') || Request::is('*pelanggan*') || Request::is('*customer*') || Request::is('*costumer*') || Request::routeIs('daftar.pelanggan') || Request::routeIs('daftar.customer')) ? 'active' : '' }}" href="#sidebarLaporan" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('*laporan*') || Request::is('*Laporan*') || Request::is('*pelanggan*') || Request::is('*customer*') || Request::is('*costumer*') || Request::routeIs('daftar.pelanggan') || Request::routeIs('daftar.customer')) ? 'true' : 'false' }}" aria-controls="sidebarLaporan">
                        <span class="icon-box"><i class="ri-bar-chart-box-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Laporan</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (Request::is('*laporan*') || Request::is('*Laporan*') || Request::is('*pelanggan*') || Request::is('*customer*') || Request::is('*costumer*') || Request::routeIs('daftar.pelanggan') || Request::routeIs('daftar.customer')) ? 'show' : '' }}" id="sidebarLaporan" data-bs-parent="#navbar-nav">
                        <ul class="nav nav-sm flex-column sub-menu-list">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*daftar-laporan*') && !Request::is('*daftar-laporanPembelian*')) ? 'active' : '' }}" href="{{ url('/daftar-laporan') }}">
                                    <i class="ri-file-chart-line sub-menu-icon"></i> <span class="menu-text">Laporan Penjualan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*daftar-laporanPembelian*') || Request::is('*laporanPembelian*') || Request::is('*LaporanPembelian*')) ? 'active' : '' }}" href="{{ url('/daftar-laporanPembelian') }}">
                                    <i class="ri-calculator-line sub-menu-icon"></i> <span class="menu-text">Laporan Pembelian</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*pelanggan*') || Request::is('*customer*') || Request::is('*costumer*') || Request::routeIs('daftar.pelanggan') || Request::routeIs('daftar.customer')) ? 'active' : '' }}" href="{{ route('daftar.pelanggan') }}">
                                    <i class="ri-file-user-line sub-menu-icon"></i> <span class="menu-text">Daftar Customer</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @if (Auth::user()->role == 'Pemilik')
                <div class="sidebar-divider"></div>

                <!-- Kategori Invoice -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*kategori*') || Request::routeIs('*kategori*')) ? 'active' : '' }}" href="{{ route('daftar.kategori') }}">
                        <span class="icon-box"><i class="ri-grid-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Kategori Invoice</span>
                    </a>
                </li>


                <div class="sidebar-divider"></div>

                <!-- Karyawan -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*user*') || Request::is('*karyawan*') || Request::routeIs('user.*')) ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <span class="icon-box"><i class="las la-users-cog menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Karyawan</span>
                    </a>
                </li>

                <!-- Budget Management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*budget*') || Request::routeIs('budget.*')) ? 'active' : '' }}" href="{{ route('budget.list') }}">
                        <span class="icon-box"><i class="ri-coins-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Daftar Budget</span>
                    </a>
                </li>
                @endif

                {{-- ===== ROLE: MAGANG ===== --}}
                @elseif (strtolower(Auth::user()->role) == 'magang')
                <li class="menu-title"><span data-key="t-menu">Menu Magang</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'active' : '' }}" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="{{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'true' : 'false' }}" aria-controls="sidebarProduct">
                        <span class="icon-box"><i class="las la-boxes menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Barang</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (Request::is('*barang*') || Request::is('*Barang*') || Request::is('*material*') || Request::is('*Material*') || Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listBarang') || Request::routeIs('listMaterial') || Request::routeIs('listInventaris')) ? 'show' : '' }}" id="sidebarProduct" data-bs-parent="#navbar-nav">
                        <ul class="nav nav-sm flex-column sub-menu-list">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*listBarang*') || Request::is('*barang*') || Request::is('*Barang*') || Request::is('*edit-stok*') || Request::routeIs('listBarang')) ? 'active' : '' }}" href="{{ route('listBarang') }}">
                                    <i class="las la-box-open sub-menu-icon"></i> <span class="menu-text">Daftar Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*material*') || Request::is('*Material*') || Request::routeIs('listMaterial')) ? 'active' : '' }}" href="{{ route('listMaterial') }}">
                                    <i class="las la-tools sub-menu-icon"></i> <span class="menu-text">Daftar Material</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*inventaris*') || Request::is('*Inventaris*') || Request::routeIs('listInventaris')) ? 'active' : '' }}" href="{{ route('listInventaris') }}">
                                    <i class="las la-dolly-flatbed sub-menu-icon"></i> <span class="menu-text">Daftar Inventaris</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Pembelian -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*vendor*') || Request::is('*pembelian*') || Request::is('*Pembelian*') || Request::routeIs('vendor.*') || Request::routeIs('pembelian.*')) ? 'active' : '' }}" href="{{ route('vendor.list') }}">
                        <span class="icon-box"><i class="mdi mdi-cash-minus menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Pembelian</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*spb*') || Request::is('*spk*') || Request::is('*spj*') || Request::routeIs('daftar-spb') || Request::routeIs('daftar-spk') || Request::routeIs('spj.*')) ? 'active' : '' }}" href="#sidebarSurat" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSurat">
                        <span class="icon-box"><i class="ri-mail-open-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Surat</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSurat" data-bs-parent="#navbar-nav">
                        <ul class="nav nav-sm flex-column sub-menu-list">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spb*') || Request::routeIs('daftar-spb')) ? 'active' : '' }}" href="{{ route('daftar-spb') }}">
                                    <i class="ri-truck-line sub-menu-icon"></i> <span class="menu-text">SPB</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spk*') || Request::routeIs('daftar-spk')) ? 'active' : '' }}" href="{{ route('daftar-spk') }}">
                                    <i class="ri-mail-settings-line sub-menu-icon"></i> <span class="menu-text">SPK</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ (Request::is('*spj*') || Request::routeIs('spj.*')) ? 'active' : '' }}" href="{{ route('spj.index') }}">
                                    <i class="ri-mail-send-line sub-menu-icon"></i> <span class="menu-text">SPJ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @else
                <li class="menu-title mt-3"><span data-key="t-pages">Surat</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*spk*') || Request::routeIs('daftar-spk')) ? 'active' : '' }}" href="{{ route('daftar-spk') }}">
                        <span class="icon-box"><i class="ri-mail-settings-line menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">SPK</span>
                    </a>
                </li>
                @endif

                {{-- ===== ROLE: PRODUKSI ===== --}}
                @if (strtolower(Auth::user()->role) === 'produksi')
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*material*') || Request::is('*Material*') || Request::routeIs('listMaterial')) ? 'active' : '' }}" href="{{ route('listMaterial') }}">
                        <span class="icon-box"><i class="las la-tools menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Daftar Material</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*stokTinta*') || Request::is('*tinta*') || Request::is('*Tinta*') || Request::routeIs('stokTinta')) ? 'active' : '' }}" href="{{ route('stokTinta') }}">
                        <span class="icon-box"><i class="mdi mdi-printer-3d-nozzle menu-icon"></i></span>
                        <span class="menu-text">Stok Tinta</span>
                    </a>
                </li>
                @endif
                @endif

                {{-- ===== ROLE: STOCKIST ===== --}}
                @if (Auth::user()->role === 'Stockist')
                <li class="nav-item mt-2">
                    <a class="nav-link menu-link {{ (Request::is('*listBarang*') || Request::is('*barang*') || Request::is('*Barang*') || Request::routeIs('listBarang')) ? 'active' : '' }}" href="{{ route('listBarang') }}">
                        <span class="icon-box"><i class="las la-box-open menu-icon"></i></span>
                        <span class="menu-text" data-key="t-invoices">Daftar Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (Request::is('*stokTinta*') || Request::is('*tinta*') || Request::is('*Tinta*') || Request::routeIs('stokTinta')) ? 'active' : '' }}" href="{{ route('stokTinta') }}">
                        <span class="icon-box"><i class="mdi mdi-printer-3d-nozzle menu-icon"></i></span>
                        <span class="menu-text">Stok Tinta</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- BOTTOM: User Account Footer (Modern Shadcn Dropup) -->
    <div class="sidebar-user-footer">
        <div class="dropup w-100">
            <button type="button" class="btn user-trigger-btn d-flex align-items-center w-100" data-bs-toggle="dropdown" data-bs-offset="[0, 10]" aria-expanded="false">
                <div class="user-avatar-badge">
                    <span class="avatar-fallback">{{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}</span>
                </div>
                <div class="user-meta">
                    <div class="text-truncate overflow-hidden text-start">
                        <span class="user-name text-truncate d-block">{{ Auth::user()->nama ?? 'User' }}</span>
                        <span class="user-role-label text-truncate d-block">{{ Auth::user()->role ?? 'Admin' }}</span>
                    </div>
                    <i class="ri-expand-up-down-line user-chevron ms-auto text-muted"></i>
                </div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark shadcn-dropdown-menu">
                <div class="shadcn-menu-inner">
                    <div class="px-3 py-2.5 border-bottom border-secondary border-opacity-25 user-dropdown-header">
                        <div class="d-flex align-items-center gap-2">
                            <div class="user-avatar-badge size-sm">
                                <span class="avatar-fallback">{{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}</span>
                            </div>
                            <div class="text-start overflow-hidden">
                                <span class="fw-bold fs-13 d-block text-truncate user-dropdown-header-name" style="letter-spacing: -0.01em;">{{ Auth::user()->nama ?? 'User' }}</span>
                                <span class="fs-11 d-block text-truncate user-dropdown-header-role">{{ Auth::user()->role ?? 'Staff' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-1">
                        @if (\Route::has('auth.profile'))
                        <a class="dropdown-item shadcn-item d-flex align-items-center gap-2 mt-1" href="{{ route('auth.profile') }}">
                            <i class="las la-user-circle fs-16 text-primary"></i>
                            <span>Profil</span>
                        </a>
                        @endif
                        <div class="dropdown-divider my-1 border-secondary opacity-25"></div>
                        <a class="dropdown-item shadcn-item d-flex align-items-center gap-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="las la-sign-out-alt fs-16"></i>
                            <span>Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<div class="vertical-overlay"></div>
