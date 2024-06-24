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
            <!-- Card Suplier -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Suplier</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $suplier->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Barang -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Barang Masuk -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang_masuk->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-circle-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card Barang Keluar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barang Keluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang_keluar->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-circle-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
           

        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
