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
        <h1 class="h3 mb-2 text-gray-800">Data Inventory</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Inventory</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a  href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahInventory">Tambah</a>
            @include('Inventory.modal')
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
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->jumlah}}  {{ $item->satuan }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editInventory{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-pen fa-sm fa-fw mr-2"></i></a>
                                        @include('Inventory.modal-edit', ['item' => $item])
                                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash fa-sm fa-fw mr-2"></i></button>
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
                var modal_id = '#editInventory' + inventory_id;
                $.ajax({
                    url: '/inventory/' + inventory_id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $(modal_id + 'Label').text('Edit Data Inventory');
                        $(modal_id + ' form').attr('action', '/inventory/' + inventory_id);
                        $(modal_id + ' #id').val(response.id);
                        $(modal_id + ' #nama_barang').val(response.nama_barang);
                        $(modal_id + ' #kategori').val(response.kategori);
                        $(modal_id + ' #jumlah').val(response.jumlah);
                        $(modal_id + ' #satuan').val(response.satuan);
                    }
                    error: function(err) {
                        console.log(err);
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
