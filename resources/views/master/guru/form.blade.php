@extends('layouts.app')

@section('title', isset($guru) ? 'Edit Guru' : 'Tambah Guru')

@section('page-actions')
    <a href="{{ route('master.guru.index') }}" class="btn btn-secondary">
        <i class="ti ti-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($guru) ? route('master.guru.update', $guru) : route('master.guru.store') }}" method="POST">
            @csrf
            @if (isset($guru)) @method('PUT') @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIP <span class="text-muted">(opsional)</span></label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                           value="{{ old('nip', $guru->nip ?? '') }}">
                    @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $guru->nama ?? '') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('gender', $guru->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $guru->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $guru->no_hp ?? '') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ old('status', $guru->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $guru->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bidang</label>
                    <input type="text" name="bidang" class="form-control" value="{{ old('bidang', $guru->bidang ?? '') }}" placeholder="Matematika, Bahasa Indonesia, dll">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Maksimal Jam Mengajar / Minggu</label>
                    <input type="number" name="maks_jam" class="form-control @error('maks_jam') is-invalid @enderror"
                           value="{{ old('maks_jam', $guru->maks_jam ?? 24) }}" min="1" max="40" required>
                    @error('maks_jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="ti ti-save"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
