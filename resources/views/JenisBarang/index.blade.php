@extends('layouts.master')

@section('title', 'Data Inventory')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@push('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Jenis Barang</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Jenis Barang</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a  href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahJenisBarang">Tambah</a>
            @include('JenisBarang.modal')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">No.</th>
                                <th>Jenis Barang</th>
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_barang }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editJenisBarang{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-pen fa-sm fa-fw"></i></a>
                                        @include('JenisBarang.modal-edit', ['item' => $item])
                                        <form action="{{ route('jenis-barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash fa-sm fa-fw"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var jenis_barang_id = $(this).data('id');
                $.ajax({
                    url: '/jenis-barang/' + jenis_barang_id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#edit-jenis').attr('action', '/jenis-barang/' + jenis_barang_id);
                        $('#jenis_barang').val(data.jenis_barang);
                    }
                });
            });
        });
    </script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
