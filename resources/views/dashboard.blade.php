@extends('layouts.master')

@section('title', 'Dashboard')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-900">Dashboard</h1>

        <div class="row">
            @if (auth()->user()->role == 'admin')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Karyawan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $karyawan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Panen</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $panen }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-leaf fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Pemasukan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pemasukan</div>
                                @if(Auth::user()->role == 'admin')
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatToRupiah($pemasukan) }}</div>
                                @else
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatToRupiah(Auth::user()->karyawan->panen->sum('total_gaji')) }}</div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <!-- Total Pengeluaran -->
            @if (auth()->user()->role == 'admin')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Pengeluaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatToRupiah($pengeluaran) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endif
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection