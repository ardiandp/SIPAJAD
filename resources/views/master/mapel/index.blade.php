@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('page-actions')
    <a href="{{ route('master.mapel.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Tambah Mapel
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kelompok</th>
                    <th>Durasi (menit)</th>
                    <th>Jam/Minggu</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapels as $mapel)
                <tr>
                    <td>{{ $mapel->kode }}</td>
                    <td>{{ $mapel->nama }}</td>
                    <td>{{ $mapel->kelompok }}</td>
                    <td>{{ $mapel->durasi }}</td>
                    <td>{{ $mapel->jam_per_minggu }}</td>
                    <td>{{ $mapel->jenis }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.mapel.edit', $mapel) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.mapel.destroy', $mapel) }}" method="POST" onsubmit="return confirm('Hapus mapel ini?')">
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
