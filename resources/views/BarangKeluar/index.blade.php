@extends('layouts.master')

@section('title', 'Data Barang Keluar')

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
        <h1 class="h3 mb-2 text-gray-800">Data Barang Keluar</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Barang Keluar</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahBarangKeluar">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">No.</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang_keluar as $item)
                                <tr>
                                    <td width="40px">{{ $loop->iteration }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->barang->jenis_barang->jenis_barang }}</td>
                                    <td>{{ $item->jumlah_keluar }} {{ $item->barang->satuan }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ formatToDate($item->tanggal_keluar) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editBarangKeluar{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-pen fa-sm fa-fw"></i></a>
                                        @include('BarangKeluar.modal-edit', ['item' => $item])
                                        <form action="{{ route('barang-keluar.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm fa-fw"></i></button>
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
@include('BarangKeluar.modal-create')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var inventory_id = $(this).data('id');
                var modal_id = '#editBarangKeluar' + inventory_id;
                $.ajax({
                    url: '/barang-keluar/' + inventory_id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $(modal_id + 'Label').text('Edit Data Keluar');
                        $(modal_id + ' form').attr('action', '/barang-keluar/' + inventory_id);
                        $(modal_id + ' #nama_barang').val(response.data_barang_id);
                        $(modal_id + ' #jumlah').val(response.jumlah_keluar);
                        $(modal_id + ' #tanggal_keluar').val(response.tanggal_keluar);
                        $(modal_id + ' #deskripsi').val(response.deskripsi);
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
