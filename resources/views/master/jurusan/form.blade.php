@extends('layouts.app')

@section('title', isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan')

@section('page-actions')
    <a href="{{ route('master.jurusan.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($jurusan) ? route('master.jurusan.update', $jurusan) : route('master.jurusan.store') }}" method="POST">
            @csrf @if(isset($jurusan)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Kode Jurusan</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                           value="{{ old('kode', $jurusan->kode ?? '') }}" required placeholder="AKL, OTKP, BDP">
                    @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label required">Nama Jurusan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $jurusan->nama ?? '') }}" required placeholder="Akuntansi dan Keuangan Lembaga">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $jurusan->keterangan ?? '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
