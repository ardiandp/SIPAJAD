@extends('layouts.app')

@section('title', 'Data Kelas')

@section('page-actions')
    <a href="{{ route('master.kelas.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Kelas</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Tingkat</th>
                    <th>Jurusan</th>
                    <th>Wali Kelas</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $k)
                <tr>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->tingkat }}</td>
                    <td>{{ $k->jurusan->nama ?? '-' }}</td>
                    <td>{{ $k->waliKelas->nama ?? '-' }}</td>
                    <td>{{ $k->ruangan->nama ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.kelas.edit', $k) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.kelas.destroy', $k) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?')">
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
