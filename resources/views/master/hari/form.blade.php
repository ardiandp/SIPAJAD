@extends('layouts.app')

@section('title', isset($hari) ? 'Edit Hari' : 'Tambah Hari')

@section('page-actions')
    <a href="{{ route('master.hari.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($hari) ? route('master.hari.update', $hari) : route('master.hari.store') }}" method="POST">
            @csrf @if(isset($hari)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Urutan</label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                           value="{{ old('urutan', $hari->urutan ?? '') }}" min="1" required>
                    @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label required">Nama Hari</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $hari->nama ?? '') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
