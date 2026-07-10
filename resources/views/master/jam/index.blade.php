@extends('layouts.app')

@section('title', 'Jam Pelajaran')

@section('page-actions')
    <a href="{{ route('master.jam.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Tambah Jam</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jamList as $j)
                <tr>
                    <td>{{ $j->urutan }}</td>
                    <td>{{ $j->nama }}</td>
                    <td>{{ $j->waktu_mulai }}</td>
                    <td>{{ $j->waktu_selesai }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('master.jam.edit', $j) }}" class="btn btn-sm btn-warning"><i class="ti ti-edit"></i></a>
                        <form action="{{ route('master.jam.destroy', $j) }}" method="POST" onsubmit="return confirm('Hapus jam ini?')">
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
