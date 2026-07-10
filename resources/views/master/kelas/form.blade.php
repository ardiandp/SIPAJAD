@extends('layouts.app')

@section('title', isset($kelas) ? 'Edit Kelas' : 'Tambah Kelas')

@section('page-actions')
    <a href="{{ route('master.kelas.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($kelas) ? route('master.kelas.update', $kelas) : route('master.kelas.store') }}" method="POST">
            @csrf @if(isset($kelas)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Nama Kelas</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $kelas->nama ?? '') }}" required placeholder="X IPA 1">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Tingkat</label>
                    <select name="tingkat" class="form-select" required>
                        <option value="10" {{ old('tingkat', $kelas->tingkat ?? '') == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ old('tingkat', $kelas->tingkat ?? '') == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ old('tingkat', $kelas->tingkat ?? '') == '12' ? 'selected' : '' }}>12</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan_id" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach ($jurusans as $j)
                            <option value="{{ $j->id }}" {{ old('jurusan_id', $kelas->jurusan_id ?? '') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Wali Kelas</label>
                    <select name="wali_kelas_id" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach ($gurus as $g)
                            <option value="{{ $g->id }}" {{ old('wali_kelas_id', $kelas->wali_kelas_id ?? '') == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ruangan</label>
                    <select name="ruangan_id" class="form-select">
                        <option value="">-- Pilih --</option>
                        @foreach ($ruangans as $r)
                            <option value="{{ $r->id }}" {{ old('ruangan_id', $kelas->ruangan_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
