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
                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ $user->name }}">
                @if($errors->has('nama'))
                    <div class="text-danger">{{ $errors->first('nama') }}</div>
                @endif
            </div>
            <div class="form-group mandatory">
                <label class="form-label" for="username">Username</label>
                <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Masukkan Username" value="{{ $user->username }}">
                @if($errors->has('username'))
                    <div class="text-danger">{{ $errors->first('username') }}</div>
                @endif
            </div>
            <div class="form-group mandatory">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Masukkan Email" value="{{ $user->email }}">
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
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