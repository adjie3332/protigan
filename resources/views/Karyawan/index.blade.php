@extends('layouts.master')

@section('title', 'Data Karyawan')

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
        <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Karyawan</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-sm" >Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10px" >No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Umur</th>
                                <th>No. Telp</th>
                                <th width="110px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->umur }}</td>
                                    <td>{{ $item->no_telepon }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm show-btn" data-bs-toggle="modal" data-bs-target="#showModal{{ $item->id }}" data-id="{{ $item->id }}"><i class="fas fa-eye fa-sm fa-fw"></i></a>
                                        @include('Karyawan.show')
                                        <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen fa-sm fa-fw"></i></a>
                                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fas fa-trash fa-sm fa-fw"></i></button>
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
    {{-- <script>
        $(document).ready(function() {
            $('#foto').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#foto').next('label').html(fileName);
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Fungsi untuk menangani klik tombol Show
            $('.show-btn').click(function() {
                var Id = $(this).data('id');
                $('#showModal' + Id).modal('show');
            });
        });
    </script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
