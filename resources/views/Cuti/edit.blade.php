@extends('layouts.master')

@section('title', 'Pengajuan Cuti')

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
        <h1 class="h3 mb-2 text-gray-800">Edit Pengajuan Cuti</h1>
        <div class="d-flex justify-content-end">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Data Cuti</a></li>
                    <li class = "breadcrumb-item active" aria-current="page">Edit Pengajuan Cuti</li>
                </ol>
            </nav>
        </div>
    <div class="card ">
        <div class="card-body">
            <form action="{{ route('cuti.update', $cuti->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mandatory">
                    <label class="form-label" for="data_karyawan_id">Nama Karyawan</label>
                    <select class="form-control form-control-sm" id="data_karyawan_id" name="data_karyawan_id">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawan as $item)
                            <option value="{{ $item->id }}" {{ $cuti->data_karyawan_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('data_karyawan_id'))
                        <div class="text-danger">{{ $errors->first('data_karyawan_id') }}</div>
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-group mandatory col-md-6">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai Cuti</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $cuti->tanggal_mulai }}" required>
                        @if($errors->has('tanggal_mulai'))
                            <div class="text-danger">{{ $errors->first('tanggal_mulai') }}</div>
                        @endif
                    </div>
                    <div class="form-group mandatory col-md-6">
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai Cuti</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ $cuti->tanggal_selesai }}" required>
                        @if($errors->has('tanggal_selesai'))
                            <div class="text-danger">{{ $errors->first('tanggal_selesai') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group mandatory">
                    <label class="form-label" for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $cuti->keterangan }}</textarea>
                    @if($errors->has('keterangan'))
                        <div class="text-danger">{{ $errors->first('keterangan') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection