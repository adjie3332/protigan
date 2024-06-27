@extends('layouts.master')

@section('title', 'Profile')

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
        <h1 class="h3 mb-2 text-gray-800">Profile</h1>

        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
        <!-- Profile -->
        <div class="row gutters-sm">
            {{-- <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if(Auth::user()->karyawan->foto === null)
                        <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="Admin" class="rounded-circle" width="150">
                    @else
                        <img src="{{ asset('images/'.Auth::user()->karyawan->foto) }}" alt="Admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{ Auth::user()->username }}</h4>
                      <p class="text-secondary mb-1">{{ Auth::user()->role }}</p>
                      <p class="text-muted font-size-sm">{{ Auth::user()->karyawan->alamat }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
            <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nama</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->username }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-info btn-sm">Edit Profile</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.change-password', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mandatory">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Masukkan Password">
                            </div>
                            <div class="form-group mandatory">
                                <label class="form-label" for="new_password">New Password</label>
                                <input type="password" class="form-control form-control-sm" id="new_password" name="new_password" placeholder="Masukkan New Password">
                            </div>
                        <button type="submit" class="btn btn-success btn-sm">Change Password</button>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
