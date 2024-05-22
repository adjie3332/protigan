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
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahInventoryKeluar">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">No.</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Keperluan</th>
                                <th>Penerima</th>
                                <th>Tanggal</th>
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventoryKeluar as $item)
                                <tr>
                                    <td width="40px">{{ $loop->iteration }}</td>
                                    <td>{{ $item->inventory->nama_barang }}</td>
                                    <td>{{ $item->inventory->kategori }}</td>
                                    <td>{{ $item->jumlah_keluar }} {{ $item->inventory->satuan }}</td>
                                    <td>{{ $item->keperluan }}</td>
                                    <td>{{ $item->karyawan->nama }}</td>
                                    <td>{{ formatToDate($item->tanggal_keluar) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editInventoryKeluar{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-pen fa-sm fa-fw mr-2"></i></a>
                                        @include('Inventory.modal-edit-keluar', ['item' => $item])
                                        <form action="{{ route('inventory-keluar.destroy', $item->id) }}" method="POST" class="d-inline">
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
@include('Inventory.modal-keluar')
@endsection
@push('scripts')
    <!-- Script untuk menampilkan foto -->
    <script>
        $(document).ready(function() {
            $('#foto').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#foto').next('label').html(fileName);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var inventory_id = $(this).data('id');
                var modal_id = '#editInventoryKeluar' + inventory_id;
                $.ajax({
                    url: '/inventory-keluar/' + inventory_id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $(modal_id + 'Label').text('Edit Data Keluar');
                        $(modal_id + ' form').attr('action', '/inventory-keluar/' + inventory_id);
                        $(modal_id + ' #nama_barang').val(response.data_inventory_id);
                        $(modal_id + ' #penerima').val(response.data_karyawan_id);
                        $(modal_id + ' #jumlah').val(response.jumlah_keluar);
                        $(modal_id + ' #tanggal_keluar').val(response.tanggal_keluar);
                        $(modal_id + ' #keperluan').val(response.keperluan);
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
