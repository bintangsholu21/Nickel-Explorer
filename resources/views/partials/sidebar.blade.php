<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-atom"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: 0.8rem">Nickel Explorer</div>
    </a>


    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ Route::currentRouteNamed('pemesanan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pemesanan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pemesanan</span>
        </a>
    </li>

    @php
        $role = Auth::user()->role; // Ambil role pengguna saat ini
    @endphp

    @if ($role == 'admin')
        <li class="nav-item {{ Route::currentRouteNamed('logPemesanan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('logPemesanan') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Aktifitas Pemesanan</span>
            </a>
        </li>
    @endif




    <hr class="sidebar-divider d-none d-md-block">

</ul>
