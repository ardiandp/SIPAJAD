@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('page-actions')
    <a href="{{ route('master.ruangan.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Ruangan</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kapasitas</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruangans as $r)
                <tr>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->kapasitas }}</td>
                    <td>{{ $r->jenis }}</td>
                    <td>{{ $r->keterangan ?? '-' }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.ruangan.edit', $r) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.ruangan.destroy', $r) }}" method="POST" onsubmit="return confirm('Hapus ruangan ini?')">
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
