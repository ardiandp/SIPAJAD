@extends('layouts.app')

@section('title', 'Jadwal Keseluruhan')

@section('page-actions')
    @if($version)
        <button class="btn btn-primary" onclick="window.print()"><i class="ti ti-printer"></i> Cetak</button>
    @endif
@endsection

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Versi Jadwal</label>
                <select name="version_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Versi --</option>
                    @foreach ($versions as $v)
                        <option value="{{ $v->id }}" {{ $selectedVersion == $v->id ? 'selected' : '' }}>
                            {{ $v->nama }} ({{ $v->status }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Filter Kelas</label>
                <select name="kelas_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelasAll as $k)
                        <option value="{{ $k->id }}" {{ $selectedKelas == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }} {{ $k->jurusan ? '(' . $k->jurusan->kode . ')' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <a href="{{ route('jadwal.keseluruhan') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="row row-cards mb-3">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="text-muted">Total Jadwal</div>
                <div class="h2 mb-0">{{ $totalEntri }} Entri</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="text-muted">Guru Terjadwal</div>
                <div class="h2 mb-0">{{ $totalGuru }} Guru</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="text-muted">Kelas Terisi</div>
                <div class="h2 mb-0">{{ $totalKelasTerisi }} Kelas</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="text-muted">Total JP</div>
                <div class="h2 mb-0">{{ $totalJP }} JP</div>
            </div>
        </div>
    </div>
</div>

@if($version && $jadwal->isNotEmpty())
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-timetable">
                    <thead>
                        <tr>
                            <th class="bg-light" style="width:100px">Jam</th>
                            @foreach ($hariList as $hari)
                                <th class="bg-light text-center">{{ $hari->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jamList as $jam)
                            @php
                                $isIstirahat = str_contains(strtolower($jam->nama), 'istirahat');
                            @endphp
                            <tr class="{{ $isIstirahat ? 'table-secondary' : '' }}">
                                <td class="fw-bold bg-light align-middle" style="white-space:nowrap">
                                    {{ $jam->nama }}
                                    @if(!$isIstirahat)
                                        <br><small class="text-muted">{{ date('H:i', strtotime($jam->waktu_mulai)) }}-{{ date('H:i', strtotime($jam->waktu_selesai)) }}</small>
                                    @else
                                        <br><small class="text-muted">({{ date('H:i', strtotime($jam->waktu_mulai)) }}-{{ date('H:i', strtotime($jam->waktu_selesai)) }})</small>
                                    @endif
                                </td>
                                @foreach ($hariList as $hari)
                                    @php
                                        $entries = $jadwal->where('hari_id', $hari->id)->where('jam_id', $jam->id);
                                    @endphp
                                    <td class="align-middle" style="min-height:60px; padding:4px;">
                                        @if($isIstirahat)
                                            <span class="text-muted fst-italic">Istirahat</span>
                                        @elseif($entries->count() > 0)
                                            @foreach ($entries as $entry)
                                                <div class="mb-1 p-1 rounded" style="background:#f0f5ff; border-left:3px solid #206bc4;">
                                                    <div class="fw-bold small">{{ $entry->mataPelajaran->nama }}</div>
                                                    <div class="small">{{ $entry->guru->nama }}</div>
                                                    <div class="small text-muted">{{ $entry->kelas->nama }} | {{ $entry->ruangan->nama }}</div>
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-muted" style="font-size:11px;">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="card-title">Detail Jadwal</h4>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal->sortBy([fn($a, $b) => $a->hari->urutan <=> $b->hari->urutan ?: $a->jam->urutan <=> $b->jam->urutan ?: strcmp($a->kelas->nama, $b->kelas->nama)]) as $entry)
                        <tr>
                            <td>{{ $entry->hari->nama }}</td>
                            <td>{{ $entry->jam->nama }}<br><small class="text-muted">{{ date('H:i', strtotime($entry->jam->waktu_mulai)) }}-{{ date('H:i', strtotime($entry->jam->waktu_selesai)) }}</small></td>
                            <td>{{ $entry->kelas->nama }}</td>
                            <td>{{ $entry->mataPelajaran->nama }}</td>
                            <td>{{ $entry->guru->nama }}</td>
                            <td>{{ $entry->ruangan->nama }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@elseif($version && $jadwal->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="ti ti-calendar-off" style="font-size:48px; color:#ccc;"></i>
            <h4 class="mt-3">Belum Ada Jadwal</h4>
            <p class="text-muted">Versi ini belum memiliki jadwal. Klik "Generate" di halaman Versi Jadwal.</p>
            <a href="{{ route('jadwal.versi') }}" class="btn btn-primary">Kembali ke Versi Jadwal</a>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="ti ti-select" style="font-size:48px; color:#ccc;"></i>
            <h4 class="mt-3">Pilih Versi Jadwal</h4>
            <p class="text-muted">Pilih versi jadwal di atas untuk melihat jadwal keseluruhan.</p>
        </div>
    </div>
@endif
@endsection

@push('styles')
<style>
    .table-timetable td, .table-timetable th {
        vertical-align: middle;
        font-size: 12px;
    }
    .table-timetable td {
        min-width: 100px;
    }
    @media print {
        .navbar, .navbar-vertical, .page-header, .card .card-body form, footer, .btn { display: none !important; }
        .page { margin: 0; padding: 0; }
        .card { border: none !important; box-shadow: none !important; }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        if($('.datatable').length) {
            $('.datatable').DataTable({
                pageLength: 50,
                order: []
            });
        }
    });
</script>
@endpush
