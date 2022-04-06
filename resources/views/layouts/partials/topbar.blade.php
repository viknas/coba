<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        @php
          $notif = \App\Models\Pengingat::select(
                                        'barang',
                                        \DB::raw('date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week) AS deadline'),
                                        \DB::raw('date_sub(DATE_FORMAT(date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week), "%Y-%m-%d"), INTERVAL 1 day) AS dead')
                                        )
                ->whereDate(\DB::raw('date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week)'), date('Y-m-d'))
                ->orderBy('deadline')
                ->get();

        $deleteNotif = \App\Models\Pengingat::select(
                          'barang',
                          \DB::raw('date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week) AS deadline'),
                          \DB::raw('date_sub(DATE_FORMAT(date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week), "%Y-%m-%d"), INTERVAL 1 day) AS dead')
                          )
        ->whereDate(\DB::raw('date_add(DATE_FORMAT(created_at, "%Y-%m-%d"),interval deadline week)'), '<', date('Y-m-d'))
        ->delete();
        @endphp
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter">{{ count($notif) }}</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Notifikasi
          </h6>
          @forelse ($notif as $value)
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3">
                <div class="icon-circle bg-primary">
                  <i class="fas fa-file-alt text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">{{ $value->deadline }}</div>
                <span class="font-weight-bold">Ayo segera beli {{ $value->barang }}.</span>
              </div>
            </a>
          @empty
            <p class="mt-2 ml-2">Belum ada notifikasi.</p>
          @endforelse
          <a class="dropdown-item text-center small text-gray-500" href="#">Notifikasi</a>
        </div>
      </li>
      

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
          <i class="fas fa-fw text-success fa-user-circle"></i>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          {{-- <a class="dropdown-item" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
          </a>
          <div class="dropdown-divider"></div> --}}
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>