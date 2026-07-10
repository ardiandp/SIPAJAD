@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('page-actions')
    <a href="{{ route('master.jurusan.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Jurusan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Jurusan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusans as $j)
                <tr>
                    <td>{{ $j->kode }}</td>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->keterangan ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.jurusan.edit', $j) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.jurusan.destroy', $j) }}" method="POST" onsubmit="return confirm('Hapus jurusan ini?')">
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
