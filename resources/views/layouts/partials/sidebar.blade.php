<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
      <div class="sidebar-brand-icon">
        <img src="image/logo/logo.png" alt="" class="rounded img-fluid w-50">
      </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::segment(1) == 'dashboard' || Request::segment(1) == '' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Ulasan Menu -->
    <li class="nav-item {{ Request::segment(1) == 'ulasan' || Request::segment(1) == '' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('ulasan.index') }}">
        <i class="fas fa-fw fa-info"></i>
        <span>Ulasan</span></a>
    </li>

    <!-- Nav Item - Pelanggan Menu -->
    <li class="nav-item {{ Request::segment(1) == 'pelanggan' || Request::segment(1) == '' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Pelanggan</span></a>
    </li>

    <!-- Nav Item - Kelola Keuangan Menu -->
    <li class="nav-item {{ Request::segment(1) == 'kelola-keuangan' ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-hand-holding-usd"></i>
        <span>Kelola Keuangan</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{ route('pengingat.index') }}">Pengingat</a>
          <a class="collapse-item" href="{{ route('pendapatan.index') }}">Pendapatan</a>
          <a class="collapse-item" href="{{ route('riwayat.index') }}">Riwayat</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Ubah Link Menu -->
    <li class="nav-item {{ Request::segment(1) == 'web-profile' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('web-profile.index') }}">
        <i class="fas fa-fw fa-link"></i>
        <span>Ubah Web Profile</span></a>
    </li>
    
    <!-- Nav Item - Rekomendasi Menu -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('rekomendasi.index') }}">
        <i class="fas fa-fw fa-star"></i>
        <span>Rekomendasi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>