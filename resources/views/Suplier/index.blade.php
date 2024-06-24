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
        <h1 class="h3 mb-2 text-gray-800">Data Suplier</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Suplier</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a  href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahSuplier">Tambah</a>
            @include('Suplier.modal')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px">No.</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suplier as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_suplier }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editSuplier{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-pen fa-sm fa-fw"></i></a>
                                        @include('Suplier.modal-edit', ['item' => $item])
                                        <form action="{{ route('suplier.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash fa-sm fa-fw"></i></button>
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
                var suplier_id = $(this).data('id');
                $.ajax({
                    url: '/suplier/' + suplier_id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#editSuplier' + suplier_id).find('.nama_suplier').val(data.nama_suplier);
                        $('#editSuplier' + suplier_id).find('.alamat').val(data.alamat);
                        $('#editSuplier' + suplier_id).find('.no_telp').val(data.no_telp);
                        $('#editSuplier' + suplier_id).find('.email').val(data.email);
                        $('#editSuplier' + suplier_id).find('.id').val(data.id);
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
