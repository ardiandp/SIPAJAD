@extends('layouts.app')

@section('title', 'Data Guru')

@section('page-actions')
    <a href="{{ route('master.guru.create') }}" class="btn btn-primary">
        <i class="ti ti-plus"></i> Tambah Guru
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Bidang</th>
                        <th>Max Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gurus as $guru)
                    <tr>
                        <td>{{ $guru->nip ?? '-' }}</td>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->gender == 'L' ? 'Laki-laki' : ($guru->gender == 'P' ? 'Perempuan' : '-') }}</td>
                        <td>{{ $guru->no_hp ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $guru->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ $guru->status }}
                            </span>
                        </td>
                        <td>{{ $guru->bidang ?? '-' }}</td>
                        <td>{{ $guru->maks_jam }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('master.guru.edit', $guru) }}" class="btn btn-sm btn-warning">
                                <i class="ti ti-edit"></i>
                            </a>
                            <form action="{{ route('master.guru.destroy', $guru) }}" method="POST" onsubmit="return confirm('Hapus guru ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>
@endpush
