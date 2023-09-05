<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="default.html" target="_blank">
            <img data-src="{{ asset('logo/icon-logo.png') }}" class="navbar-brand-img h-100 lozad" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ config('app.name') }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboards</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PAGES</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesProduks"
                    class="nav-link {{ request()->routeIs('produk.*') || request()->routeIs('kategori.*') ? 'active' : '' }}"
                    aria-controls="pagesProduks" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Produks</span>
                </a>
                <div class="collapse {{ request()->routeIs('produk.*') || request()->routeIs('kategori.*') || request()->routeIs('brand.*') || request()->routeIs('type.*') ? 'show' : '' }}"
                    id="pagesProduks">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('produk.index') ? 'active' : '' }}"
                                href="{{ route('produk.index') }}">
                                <span class="sidenav-mini-icon text-xs"> P </span>
                                <span class="sidenav-normal"> List Produk </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('brand.*') ? 'active' : '' }}"
                                href="{{ route('brand.index') }}">
                                <span class="sidenav-mini-icon text-xs"> B </span>
                                <span class="sidenav-normal"> Brands </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
                                href="{{ route('kategori.index') }}">
                                <span class="sidenav-mini-icon text-xs"> K </span>
                                <span class="sidenav-normal"> Kategori </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ request()->routeIs('type.*') ? 'active' : '' }}"
                                href="{{ route('type.index') }}">
                                <span class="sidenav-mini-icon text-xs"> T </span>
                                <span class="sidenav-normal"> Types Produk </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('pengguna.index') }}"
                    class="nav-link {{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pengguna</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">SETTINGS </h6>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-image text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Banners</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesSettings"
                    class="nav-link {{ request()->routeIs('setting.*') || request()->routeIs('metode-pembayaran.*') ? 'active' : '' }}"
                    aria-controls="pagesSettings" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Settings</span>
                </a>
                <div class="collapse {{ request()->routeIs('setting.*') || request()->routeIs('metode-pembayaran.*') ? 'show' : '' }}"
                    id="pagesSettings">
                    <ul class="nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('setting.index') ? 'active' : '' }}"
                                href="{{ route('setting.index') }}">
                                <span class="sidenav-mini-icon text-xs"> W </span>
                                <span class="sidenav-normal"> General Setting </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('metode-pembayaran.*') ? 'active' : '' }}"
                                href="{{ route('metode-pembayaran.index') }}">
                                <span class="sidenav-mini-icon text-xs"> M </span>
                                <span class="sidenav-normal"> Metode Pembayaran </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 my-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Logout?</h6>
                    <p class="text-xs font-weight-bold mb-0">
                        out from this session
                    </p>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-danger btn-sm w-100 mb-3" onclick="confirmLogout('logout-form')">Logout</a>
        <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">
            @csrf
        </form>
    </div>
</aside>
