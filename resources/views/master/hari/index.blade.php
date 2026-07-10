@extends('layouts.app')

@section('title', 'Data Hari')

@section('page-actions')
    <a href="{{ route('master.hari.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Hari</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama Hari</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hariList as $h)
                <tr>
                    <td>{{ $h->urutan }}</td>
                    <td>{{ $h->nama }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.hari.edit', $h) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.hari.destroy', $h) }}" method="POST" onsubmit="return confirm('Hapus hari ini?')">
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
