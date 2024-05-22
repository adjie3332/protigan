@extends('layouts.master')

@section('title', 'Edit Data Panen')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #00acc1;
            border-radius: 4px;
            padding: 0.2rem;
        }
    </style>
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">@yield('title')</h1>
    <div class="d-flex justify-content-end">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('panen.index') }}">Data Panen</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('panen.update', $panen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mandatory">
                    <label class="form-label" for="id_karyawan">Nama Karyawan</label>
                    <select class="form-control form-control-sm @error('data_karyawan_id') is-invalid @enderror" id="id_karyawan" name="data_karyawan_id">
                        <option value="">-- Pilih Nama Karyawan --</option>
                        @foreach ($karyawan as $item)
                            <option value="{{ old('data_karyawan_id', $item->id) }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('data_karyawan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mandatory">
                    <label class="form-label" for="harga_id">Harga Karet</label>
                    <select class="form-control form-control-sm @error('harga_karet_id') is-invalid @enderror" id="harga_id" name="harga_karet_id">
                        <option value="">-- Pilih Harga Karet --</option>
                        @foreach ($harga as $item)
                            <option value="{{ old('harga_karet_id', $item->id) }}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                    @error('harga_karet_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mandatory">
                    <label class="form-label" for="tanggal">Tanggal</label>
                    <input type="date" class="form-control form-control-sm @error('tanggal_panen') is-invalid @enderror" id="tanggal" name="tanggal_panen" placeholder="Masukkan Tanggal" value="{{ old('tanggal_panen', $panen->tanggal_panen) }}">
                    @error('tanggal_panen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mandatory">
                    <label class="form-label" for="hasil_kg">Hasil (Kg)</label>
                    <input type="text" class="form-control form-control-sm @error('hasil_kg') is-invalid @enderror" id="hasil_kg" name="hasil_kg[]" placeholder="Masukkan Hasil (Kg)" data-role="tagsinput" value="{{ old('hasil_kg', $panen->hasil_kg) }}">
                    @error('hasil_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="total_hasil_kg">Total Hasil (Kg)</label>
                    <input type="text" class="form-control form-control-sm" id="total_hasil_kg" name="total_hasil_kg" placeholder="Total Hasil (Kg)" readonly>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        var hasilKgInput = $('#hasil_kg');
        var totalHasilKgInput = $('#total_hasil_kg');

        hasilKgInput.on('itemAdded itemRemoved', function () {
            var hasilKgArray = hasilKgInput.tagsinput('items').map(Number); // Convert to numbers
            var totalHasilKg = hasilKgArray.reduce((acc, val) => acc + val, 0); // Calculate sum
            totalHasilKgInput.val(totalHasilKg);
        });
    });
</script>
@endpush
