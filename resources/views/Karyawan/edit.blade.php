@extends('layouts.master')

@section('title', 'Edit Data Karyawan')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Data Karyawan</h1>
    <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Data Karyawan</a></li>
                    <li class = "breadcrumb-item active" aria-current="page">Edit Data Karyawan</li>
                </ol>
            </nav>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mandatory">
                <label class="form-label" for="nama">Nama</label>
                <input type="hidden" name="id" value="{{ $karyawan->id }}">
                <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ $karyawan->nama }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mandatory">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan Alamat">{{ $karyawan->alamat }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-row">
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control form-control-sm @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ $karyawan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $karyawan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="no_telp">No. Telp</label>
                    <input type="text" class="form-control form-control-sm @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp" value="{{ $karyawan->no_telp }}">
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="foto">Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Update</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('#foto').on('change', function() {
            // Ambil nama file foto
            let fileName = $(this).val().split('\\').pop();
            // Ubah label foto
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endpush