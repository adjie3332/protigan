{{-- @extends('layouts.master')

@section('title', 'Profile Karyawan')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->

        <div class="row">
            <div class="col-md-3">
                <div class="text-center">
                    <img src="{{ asset('images/'.$karyawan->foto) }}" class="avatar img-circle img-thumbnail" alt="avatar">
                </div>
            </div>
            <div class="col-md-9">
                <h2>{{ $karyawan->user->name }}</h2>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ $karyawan->user->name }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-sm" id="alamat" rows="3" name="alamat" placeholder="Masukkan Alamat" disabled>{{ $karyawan->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="umur">Umur</label>
                                <input type="number" class="form-control form-control-sm" id="umur" name="umur" placeholder="Masukkan Umur" value="{{ $karyawan->umur }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin" disabled>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ $karyawan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $karyawan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
@endsection --}}

{{-- Modal Show Data --}}
<div class="modal" id="showModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showModalLabel{{ $item->id }}" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showModalLabel">Detail Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mt-3 mb-4">
                            @if($item->foto)
                                <img src="{{ asset('images/' . $item->foto) }}" alt="{{ $item->nama }}" class="rounded-circle img-fluid" style="width: 200px;" />
                            @else      
                                <img src="{{ asset('assets/img/undraw_profile.svg') }}" alt="Admin" class="rounded-circle" width="150">
                            @endif
                        </div>
                        <h4 class="mb-2">{{ $item->nama }}</h4>
                        <p class="mb-4">{{ $item->alamat }}</p>
                        <div class="row text-start">
                            <div class="col-6">
                                <p class="mb-2">Umur</p>
                                <h5 class="mb-4">{{ $item->umur }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="mb-2">Jenis Kelamin</p>
                                <h5 class="mb-4">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h5>
                            </div>
                        </div>
                        <div class="row text-start">
                            <div class="col-6">
                                <p class="mb-2">E-mail</p>
                                <h5 class="mb-4">{{ $item->user->email }}</h5>
                            </div>
                            <div class="col-6">
                                <p class="mb-2">No. Telp</p>
                                <h5 class="mb-4">{{ $item->no_telepon }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

