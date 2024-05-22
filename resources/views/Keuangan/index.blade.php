@extends('layouts.master')

@section('title', 'Laporan Keuangan')

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
        <h1 class="h3 mb-2 text-gray-800">Laporan Keuangan</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan'</li>
                </ol>
            </nav>
        </div>
        <!-- DataTales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <a href="{{ route('laporan-keuangan.cetak') }}" class="btn btn-danger btn-sm" ><i class="fas fa-print fa-sm fa-fw mr-2"></i>Export PDF</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20px">No.</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?> {{-- Inisialisasi nomor urut --}}
                            
                            {{-- Loop untuk menampilkan data dari $panen --}}
                            @if ($panen->count() > 0)
                                @foreach ($panen as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td> {{-- Tampilkan dan tambahkan nomor urut --}}
                                        <td>{{ formatToDate($item->tanggal_panen) }}</td>
                                        <td>Hasil dari {{ $item->karyawan->nama }}</td>
                                        <td>{{ formatToRupiah($item->hasil_pemilik) }}</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                            @endif

                            {{-- Loop untuk menampilkan data dari $pengeluaran --}}
                            @if ($pengeluaran->count() > 0)
                                @foreach ($pengeluaran as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td> {{-- Tampilkan dan tambahkan nomor urut --}}
                                        <td>{{ formatToDate($item->tanggal_masuk) }}</td>
                                        <td>Membeli {{ $item->inventory->nama_barang }}</td>
                                        <td>-</td>
                                        <td>{{ formatToRupiah($item->harga) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th>{{  formatToRupiah($panen->sum('hasil_pemilik')) }}</th>
                                <th>{{  formatToRupiah($pengeluaran->sum('harga')) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3">Saldo</th>
                                <th colspan="2" class="text-center">{{  formatToRupiah($panen->sum('hasil_pemilik') - $pengeluaran->sum('harga')) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <!-- <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control form-control-sm" id="alamat" rows="3" name="alamat" placeholder="Masukkan Alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <input type="number" class="form-control form-control-sm" id="umur" name="umur" placeholder="Masukkan Umur">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telp</label>
                            <input type="text" class="form-control form-control-sm" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp">
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto">
                                <label class="custom-file-label" for="foto">Pilih Foto</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal -->
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
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
