@extends('layouts.app')

@section('title', isset($bebanMengajar) ? 'Edit Beban Mengajar' : 'Tambah Beban Mengajar')

@section('page-actions')
    <a href="{{ route('master.beban.index') }}" class="btn btn-secondary"><i class="ti ti-arrow-left"></i> Kembali</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($bebanMengajar) ? route('master.beban.update', $bebanMengajar) : route('master.beban.store') }}" method="POST">
            @csrf @if(isset($bebanMengajar)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Guru</label>
                    <select name="guru_id" class="form-select" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($gurus as $g)
                            <option value="{{ $g->id }}" {{ old('guru_id', $bebanMengajar->guru_id ?? '') == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="form-select" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapels as $m)
                            <option value="{{ $m->id }}" {{ old('mata_pelajaran_id', $bebanMengajar->mata_pelajaran_id ?? '') == $m->id ? 'selected' : '' }}>{{ $m->nama }} ({{ $m->kode }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Kelas</label>
                    <select name="kelas_id" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $bebanMengajar->kelas_id ?? '') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required">Jumlah Jam per Minggu</label>
                    <input type="number" name="jumlah_jam" class="form-control" value="{{ old('jumlah_jam', $bebanMengajar->jumlah_jam ?? '') }}" min="1" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="ti ti-save"></i> Simpan</button>
        </form>
    </div>
</div>
@endsection
