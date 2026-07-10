@extends('layouts.app')

@section('title', isset($jam) ? 'Edit Jam' : 'Tambah Jam')

@section('page-actions')
    <a href="{{ route('master.jam.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($jam) ? route('master.jam.update', $jam) : route('master.jam.store') }}" method="POST">
            @csrf @if(isset($jam)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label required">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $jam->urutan ?? '') }}" min="1" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label required">Nama Jam</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $jam->nama ?? '') }}" required placeholder="Jam ke-1">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label required">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror"
                           value="{{ old('waktu_mulai', $jam->waktu_mulai ?? '') }}" required>
                    @error('waktu_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label required">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" class="form-control @error('waktu_selesai') is-invalid @enderror"
                           value="{{ old('waktu_selesai', $jam->waktu_selesai ?? '') }}" required>
                    @error('waktu_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
