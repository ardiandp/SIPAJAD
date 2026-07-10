@extends('layouts.app')

@section('title', isset($mataPelajaran) ? 'Edit Mapel' : 'Tambah Mapel')

@section('page-actions')
    <a href="{{ route('master.mapel.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($mataPelajaran) ? route('master.mapel.update', $mataPelajaran) : route('master.mapel.store') }}" method="POST">
            @csrf @if(isset($mataPelajaran)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Kode</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
                           value="{{ old('kode', $mataPelajaran->kode ?? '') }}" required>
                    @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label required">Nama Mata Pelajaran</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $mataPelajaran->nama ?? '') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Kelompok</label>
                    <select name="kelompok" class="form-select" required>
                        <option value="A" {{ old('kelompok', $mataPelajaran->kelompok ?? '') == 'A' ? 'selected' : '' }}>A (Umum)</option>
                        <option value="B" {{ old('kelompok', $mataPelajaran->kelompok ?? '') == 'B' ? 'selected' : '' }}>B (Kewilayahan)</option>
                        <option value="C" {{ old('kelompok', $mataPelajaran->kelompok ?? '') == 'C' ? 'selected' : '' }}>C (Kejuruan)</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Durasi (menit)</label>
                    <input type="number" name="durasi" class="form-control" value="{{ old('durasi', $mataPelajaran->durasi ?? 45) }}" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label required">Jam/Minggu</label>
                    <input type="number" name="jam_per_minggu" class="form-control" value="{{ old('jam_per_minggu', $mataPelajaran->jam_per_minggu ?? 2) }}" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label required">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="teori" {{ old('jenis', $mataPelajaran->jenis ?? '') == 'teori' ? 'selected' : '' }}>Teori</option>
                        <option value="praktikum" {{ old('jenis', $mataPelajaran->jenis ?? '') == 'praktikum' ? 'selected' : '' }}>Praktikum</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
