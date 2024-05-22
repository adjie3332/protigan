@extends('layouts.master')

@section('title', 'Harga Karet')

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
        <h1 class="h3 mb-2 text-gray-800">Harga Karet</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Harga Karet</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            @if(Auth::user()->role == 'admin') 
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDataModal">Tambah</a>
                @include('Harga.create')
            @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20px">No.</th>
                                <th>Kategori</th>
                                <th>Harga per(Kg)</th>
                                @if(Auth::user()->role == 'admin')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($harga as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ formatToRupiah($item->harga_per_kg) }}</td>
                                    @if(Auth::user()->role == 'admin')
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editModal{{ $item->id }}" data-id="{{ $item->id }}" data-kategori="{{ $item->kategori }}" data-harga="{{ $item->harga_per_kg }}">
                                            <i class="fas fa-pen fa-sm fa-fw mr-2"></i>Edit
                                        </a>
                                        @include('Harga.edit', ['item' => $item])
                                        <form action="{{ route('harga.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash fa-sm fa-fw mr-2"></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                    @endif
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
                var harga_id = $(this).data('id');
                var modal_id = '#editModal' + harga_id;
                var kategori = $(this).data('kategori');
                var harga = $(this).data('harga');
                $.ajax({
                    url: '/harga/' + harga_id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $(modal_id + 'Label').text('Edit Data harga');
                        $(modal_id + ' form').attr('action', '/harga/' + harga_id);
                        $(modal_id + ' #kategori').val(kategori);
                        $(modal_id + ' #harga').val(harga);
                    },
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
