@extends('layouts.app')

@section('title', 'Versi Jadwal')

@section('page-actions')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
        <i class="ti ti-plus"></i> Buat Versi Baru
    </button>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="alert alert-info" role="alert">
            <strong>Alur Generate Jadwal:</strong>
            <ol class="mb-0 mt-1">
                <li>Pastikan semua data master (guru, mapel, kelas, ruangan, hari, jam) sudah terisi.</li>
                <li>Beban mengajar sudah ditentukan untuk setiap guru.</li>
                <li>Buat versi jadwal baru dengan klik <strong>"Buat Versi Baru"</strong>.</li>
                <li>Klik tombol <strong>"Generate"</strong> pada versi yang dibuat (pastikan Python scheduler berjalan).</li>
                <li>Setelah generate, klik <strong>"Lihat Jadwal"</strong> untuk melihat hasil.</li>
                <li>Jika sudah sesuai, klik <strong>"Finalkan"</strong> untuk mengunci jadwal.</li>
            </ol>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Nama Versi</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($versions as $v)
                    <tr>
                        <td class="fw-bold">{{ $v->nama }}</td>
                        <td>
                            <span class="badge {{ $v->status == 'final' ? 'bg-success' : 'bg-warning' }}">
                                {{ $v->status == 'final' ? 'Final' : 'Draft' }}
                            </span>
                        </td>
                        <td>{{ $v->creator->name ?? '-' }}</td>
                        <td>{{ $v->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                @if($v->status == 'draft')
                                    <form action="{{ route('jadwal.versi.generate', $v) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Generate jadwal untuk versi \"{{ $v->nama }}\"?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="ti ti-refresh"></i> Generate
                                        </button>
                                    </form>
                                    <a href="{{ route('jadwal.keseluruhan', ['version_id' => $v->id]) }}" class="btn btn-sm btn-info text-white">
                                        <i class="ti ti-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('jadwal.versi.finalize', $v) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Finalkan versi \"{{ $v->nama }}\"?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="ti ti-check"></i> Finalkan
                                        </button>
                                    </form>
                                    <form action="{{ route('jadwal.versi.destroy', $v) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus versi \"{{ $v->nama }}\"?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('jadwal.keseluruhan', ['version_id' => $v->id]) }}" class="btn btn-sm btn-info text-white">
                                        <i class="ti ti-calendar"></i> Lihat Jadwal
                                    </a>
                                    <form action="{{ route('jadwal.versi.destroy', $v) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus versi \"{{ $v->nama }}\"?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($versions->isEmpty())
        <div class="text-center py-5">
            <i class="ti ti-versions" style="font-size:48px; color:#ccc;"></i>
            <h4 class="mt-3">Belum Ada Versi Jadwal</h4>
            <p class="text-muted">Klik "Buat Versi Baru" untuk memulai.</p>
        </div>
        @endif
    </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('jadwal.versi.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Versi Jadwal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label required">Nama Versi</label>
                    <input type="text" name="nama" class="form-control" required placeholder="Misal: Semester Ganjil 2025/2026">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('.datatable').DataTable();
    $('form[action*="generate"]').on('submit', function(){
        var btn = $(this).find('button[type=submit]');
        btn.html('<span class="spinner-border spinner-border-sm me-1"></span> Generating...').prop('disabled', true);
    });
});
</script>
@endpush
