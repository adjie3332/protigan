@extends('layouts.master')

@section('title', 'Tambah Data Karyawan')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
        @include('layouts.alert')
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Data Karyawan</a></li>
                    <li class = "breadcrumb-item active" aria-current="page">Tambah Data Karyawan</li>
                </ol>
            </nav>
        </div>
    <div class="card ">
        <div class="card-body">
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mandatory">
                    <label class="form-label" for="nama">Nama</label>
                    <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mandatory">
                    <label class="form-label" for="alamat">Alamat</label>
                    <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" id="alamat" rows="3" name="alamat" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group mandatory col-md-6">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory col-md-6">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control form-control-sm @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group mandatory col-md-6">
                        <label class="form-label" for="no_telp">No. Telp</label>
                        <input type="text" class="form-control form-control-sm @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp" value="{{ old('no_telp') }}">
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
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group mandatory col-md-6">
                        <label for='username'>Username</label>
                        <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mandatory col-md-6">
                        <label for='email'>Email</label>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group mandatory col-md-6">
                        <label for='password'>Password</label>
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for='role'>Role</label>
                        <select class="form-control form-control-sm @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
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