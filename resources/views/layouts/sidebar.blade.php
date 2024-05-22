<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">sisperka<sup></sup></div>
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

    <!-- Karyawan -->
    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Karyawan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('karyawan.create') }}">Tambah Data Karyawan</a>
                <a class="collapse-item" href="{{ route('karyawan.index') }}">Data Karyawan</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Panen -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePanen"
            aria-expanded="true" aria-controls="collapsePanen">
            <i class="fas fa-fw fa-tree"></i>
            <span>Panen</span>
        </a>
        <div id="collapsePanen" class="collapse" aria-labelledby="headingPanen"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @if (auth()->user()->role == 'admin')
                    <a class="collapse-item" href="{{ route('panen.create') }}">Tambah Data Panen</a>        
                @endif
                <a class="collapse-item" href="{{ route('panen.index') }}">Data Panen</a>
            </div>
        </div>
    </li>

    {{-- <!-- Penghasilan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenghasilan"
            aria-expanded="true" aria-controls="collapsePenghasilan">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Penghasilan</span>
        </a>
        <div id="collapsePenghasilan" class="collapse" aria-labelledby="headingPenghasilan"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Tambah Data Penghasilan</a>
                <a class="collapse-item" href="">Data Penghasilan</a>
            </div>
        </div>
    </li>

    <!-- Pengeluaran -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Pengeluaran</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Tambah Data Pengeluaran</a>
                <a class="collapse-item" href="">Data Pengeluaran</a>
            </div>
        </div>
    </li> --}}

    <!-- Harga Karet -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHargaKaret"
            aria-expanded="true" aria-controls="collapseHargaKaret">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Harga Karet</span>
        </a>
        <div id="collapseHargaKaret" class="collapse" aria-labelledby="headingHargaKaret"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('harga.index') }}">Data Harga Karet</a>
            </div>
        </div>

    <!-- Gaji -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGaji"
            aria-expanded="true" aria-controls="collapseGaji">
            <i class="fas fa-fw fa-money-check-alt"></i>
            <span>Gaji</span>
        </a>
        <div id="collapseGaji" class="collapse" aria-labelledby="headingGaji"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('gaji.index') }}">Data Gaji</a>
            </div>
        </div>
    </li>
    
    <!-- Inventori -->
    @if(auth()->user()->role == 'admin')    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventori"
            aria-expanded="true" aria-controls="collapseInventori">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventori</span>
        </a>
        <div id="collapseInventori" class="collapse" aria-labelledby="headingInventori"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ Route('inventory.index') }}">Data Inventori</a>
                <a class="collapse-item" href="{{ Route('inventory.masuk') }}">Barang Masuk</a>
                <a class="collapse-item" href="{{ Route('inventory.keluar') }}">Barang Keluar</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Cuti -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCuti"
            aria-expanded="true" aria-controls="collapseCuti">
            <i class="fas fa-fw fa-calendar-times"></i>
            <span>Cuti</span>
        </a>
        <div id="collapseCuti" class="collapse" aria-labelledby="headingCuti"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('cuti.create') }}">Tambah Data Cuti</a>
                <a class="collapse-item" href="{{ route('cuti.index') }}">Data Cuti</a>
            </div>
        </div>
    </li>

    <!-- Laporan -->
    @if (auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('laporan-keuangan') }}">Keuangan</a>
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