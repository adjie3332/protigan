@extends('layouts.master')

@section('title', 'Data Gaji')

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
        <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Gaji</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <!-- <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDataModal">Tambah</a> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20px">No.</th>
                                <th>Karyawan</th>
                                <th>Tanggal Gaji</th>
                                <th>Kategori</th>
                                <th>Jumlah Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($panen as $item)
                                @if (Auth::user()->role == 'karyawan' && $item->karyawan->id != Auth::user()->karyawan->id)
                                    @continue
                                @endif
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->karyawan->nama }}</td>
                                    <td>{{ formatToDate($item->tanggal_panen) }}</td>
                                    <td>{{ $item->harga->kategori }}</td>
                                    <td>{{ formatToRupiah($item->total_gaji) }}</td>
                                    <td>
                                        <a href="{{ route('gaji.slip', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-print fa-sm fa-fw mr-2"></i>Print</a>
                                        @if(Auth::user()->role == 'admin')
                                        <form action="{{ route('gaji.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            {{-- @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fas fa-trash fa-sm fa-fw mr-2"></i>Hapus</button> --}}
                                        </form>  
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Gaji Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gaji.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="karyawan_id">Karyawan</label>
                            <select name="karyawan_id" id="karyawan_id" class="form-control">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('karyawan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="tanggal_gaji">Tanggal Gaji</label>
                            <input type="date" class="form-control @error('tanggal_gaji') is-invalid @enderror" id="tanggal_gaji" name="tanggal_gaji" value="{{ old('tanggal_gaji') }}">
                            @error('tanggal_gaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>  
                        <div class="form-group">
                        <label for="total_hasil_kg">Total Hasil (Kg)</label>
                            <input type="text" class="form-control @error('total_hasil_kg') is-invalid @enderror" id="total_hasil_kg" name="total_hasil_kg" value="{{ old('total_hasil_kg') }}">
                            @error('total_hasil_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_per_kg">Harga per(Kg)</label>
                            <select name="harga_per_kg" id="harga_per_kg" class="form-control">
                                <option value="">-- Pilih Harga --</option>
                                @foreach ($harga as $item)
                                    <option value="{{ $item->harga_per_kg }}">{{ $item->harga_per_kg }}</option>
                                @endforeach
                            </select>
                            @error('harga_per_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label for="gaji">Gaji</label>
                            <input type="text" class="form-control @error('gaji') is-invalid @enderror" id="gaji" name="gaji" value="{{ old('gaji') }}" disabled>
                            @error('gaji')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal --> --}}
@endsection
@push('scripts')
    <!-- Script untuk menampilkan foto -->
    <script>
        function hitungGaji() {
            var total_hasil_kg = document.getElementById('total_hasil_kg').value;
            var harga_per_kg = document.getElementById('harga_per_kg').value;
            var gaji = total_hasil_kg * harga_per_kg;
            document.getElementById('gaji').value = gaji;
        }

        document.getElementById('total_hasil_kg').addEventListener('change', hitungGaji);
        document.getElementById('harga_per_kg').addEventListener('change', hitungGaji);
    </script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
