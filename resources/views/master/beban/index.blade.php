@extends('layouts.app')

@section('title', 'Beban Mengajar')

@section('page-actions')
    <a href="{{ route('master.beban.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Beban</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <select name="guru_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Guru</option>
                    @foreach ($gurus as $g)
                        <option value="{{ $g->id }}" {{ request('guru_id') == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Guru</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Jumlah Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bebans as $b)
                <tr>
                    <td>{{ $b->guru->nama }}</td>
                    <td>{{ $b->mataPelajaran->nama }}</td>
                    <td>{{ $b->kelas->nama }}</td>
                    <td>{{ $b->jumlah_jam }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.beban.edit', $b) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.beban.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus beban ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="ti ti-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('.datatable').DataTable();});</script>
@endpush
