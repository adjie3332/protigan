<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">protigan<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Suplier -->
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSuplier"
            aria-expanded="true" aria-controls="collapseSuplier">
            <i class="fas fa-fw fa-truck"></i>
            <span>Suplier</span>
        </a>
        <div id="collapseSuplier" class="collapse" aria-labelledby="headingSuplier" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ Route('suplier.index') }}">Data Suplier</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Jenis Barang -->
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJenisBarang"
            aria-expanded="true" aria-controls="collapseJenisBarang">
            <i class="fas fa-fw fa-box"></i>
            <span>Jenis Barang</span>
        </a>
        <div id="collapseJenisBarang" class="collapse" aria-labelledby="headingJenisBarang"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ Route('jenis-barang.index') }}">Data Jenis Barang</a>
            </div>
        </div>
    </li>
    @endif
    
    <!-- Inventori -->    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventori"
            aria-expanded="true" aria-controls="collapseInventori">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventori</span>
        </a>
        <div id="collapseInventori" class="collapse" aria-labelledby="headingInventori"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ Route('barang.index') }}">Data Barang</a>
                <a class="collapse-item" href="{{ Route('barang-masuk.index') }}">Barang Masuk</a>
                <a class="collapse-item" href="{{ Route('barang-keluar.index') }}">Barang Keluar</a>
            </div>
        </div>
    </li>

    <!-- Riwayat -->
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRiwayat"
            aria-expanded="true" aria-controls="collapseRiwayat">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat</span>
        </a>
        <div id="collapseRiwayat" class="collapse" aria-labelledby="headingRiwayat"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('riwayat-masuk.index') }}" href="">Riwayat Barang Masuk</a>
                <a class="collapse-item" href="{{ route('riwayat-keluar.index') }}" href="">Riwayat Barang Keluar</a>
            </div>
        </div>
    </li>

    <!-- Pengaturan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaturan"
            aria-expanded="true" aria-controls="collapsePengaturan">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Setting</span>
        </a>
        <div id="collapsePengaturan" class="collapse" aria-labelledby="headingPengaturan"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user.index') }}">Data User</a>
            </div>
        </div>
    </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>