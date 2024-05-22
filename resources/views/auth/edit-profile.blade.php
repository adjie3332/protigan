@extends('layouts.master')

@section('title', 'Edit Profile')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
    <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
                    <li class = "breadcrumb-item active" aria-current="page">Edit Profile</li>
                </ol>
            </nav>
    </div>
    <div class="card-body">
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mandatory">
                <label class="form-label" for="nama">Nama</label>
                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ $karyawan->nama }}">
                @if($errors->has('nama'))
                    <div class="text-danger">{{ $errors->first('nama') }}</div>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Masukkan Username" value="{{ $user->username }}">
                    @if($errors->has('username'))
                        <div class="text-danger">{{ $errors->first('username') }}</div>
                    @endif
                </div>
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Masukkan Email" value="{{ $user->email }}">
                    @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group mandatory">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea class="form-control form-control-sm" id="alamat" rows="3" name="alamat" placeholder="Masukkan Alamat">{{ $karyawan->alamat }}</textarea>
                @if($errors->has('alamat'))
                    <div class="text-danger">{{ $errors->first('alamat') }}</div>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm" id="tanggal_lahir" name="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}">
                        @if($errors->has('tanggal_lahir'))
                            <div class="text-danger">{{ $errors->first('tanggal_lahir') }}</div>
                        @endif
                </div>
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ $karyawan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $karyawan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @if($errors->has('jenis_kelamin'))
                        <div class="text-danger">{{ $errors->first('jenis_kelamin') }}</div>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group mandatory col-md-6">
                    <label class="form-label" for="no_telp">No. Telp</label>
                    <input type="text" class="form-control form-control-sm" id="no_telp" name="no_telp" placeholder="Masukkan No. Telp" value="{{ $karyawan->no_telepon }}">
                    @if($errors->has('no_telp'))
                        <div class="text-danger">{{ $errors->first('no_telp') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="foto">Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                    </div>
                    @if($errors->has('foto'))
                        <div class="text-danger">{{ $errors->first('foto') }}</div>
                    @endif
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