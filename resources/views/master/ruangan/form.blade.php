@extends('layouts.app')

@section('title', isset($ruangan) ? 'Edit Ruangan' : 'Tambah Ruangan')

@section('page-actions')
    <a href="{{ route('master.ruangan.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($ruangan) ? route('master.ruangan.update', $ruangan) : route('master.ruangan.store') }}" method="POST">
            @csrf @if(isset($ruangan)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Nama Ruangan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $ruangan->nama ?? '') }}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label required">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $ruangan->kapasitas ?? 30) }}" min="1" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="kelas" {{ old('jenis', $ruangan->jenis ?? '') == 'kelas' ? 'selected' : '' }}>Kelas</option>
                        <option value="laboratorium" {{ old('jenis', $ruangan->jenis ?? '') == 'laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                        <option value="aula" {{ old('jenis', $ruangan->jenis ?? '') == 'aula' ? 'selected' : '' }}>Aula</option>
                        <option value="bengkel" {{ old('jenis', $ruangan->jenis ?? '') == 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                        <option value="lainnya" {{ old('jenis', $ruangan->jenis ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2">{{ old('keterangan', $ruangan->keterangan ?? '') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
