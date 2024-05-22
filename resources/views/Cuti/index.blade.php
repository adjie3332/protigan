@extends('layouts.master')

@section('title', 'Data Cuti')

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
        <h1 class="h3 mb-2 text-gray-800">Data Cuti</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Cuti</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a href="{{ route('cuti.create') }}" class="btn btn-primary btn-sm">Tambah</a>
            <a href="{{ route('cuti.cetak') }}" class="btn btn-danger btn-sm" ><i class="fas fa-print fa-sm fa-fw mr-2"></i>Export PDF</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Total Hari</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cuti as $item)
                            @if (Auth::user()->role == 'karyawan' && $item->karyawan->id != Auth::user()->karyawan->id)
                                @continue
                            @endif
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->karyawan->nama }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->tanggal_selesai }}</td>
                                <td>{{ $item->total_hari }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                @if(Auth::user()->role == 'admin')
                                    @if ($item->status == 'pending')
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#tambahDataModal{{ $item->id }}">{{ $item->status }}</a>
                                    @elseif ($item->status == 'disetujui')
                                        <span class="btn btn-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'ditolak')
                                        <span class="btn btn-danger">{{ $item->status }}</span>
                                    @endif
                                @else
                                    @if ($item->status == 'pending')
                                        <span class="btn btn-warning">{{ $item->status }}</span>
                                    @elseif ($item->status == 'disetujui')
                                        <span class="btn btn-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'ditolak')
                                        <span class="btn btn-danger">{{ $item->status }}</span>
                                    @endif
                                @endif
                                </td>
                                <td>
                                    <a href="{{ route('cuti.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen fa-sm fa-fw mr-2"></i>Edit</a>
                                    <form action="{{ route('cuti.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm fa-fw mr-2"></i>Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal Update Status -->
                            <div class="modal fade" id="tambahDataModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahDataModalLabel">Validasi Pengajuan Cuti</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('cuti.update-status', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success" name="status" value="disetujui">Disetujui</button>
                                                <button type="submit" class="btn btn-danger" name="status" value="ditolak">Ditolak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
