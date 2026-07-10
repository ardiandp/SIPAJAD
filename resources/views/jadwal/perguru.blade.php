@extends('layouts.app')

@section('title', 'Jadwal Per Guru')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-5">
                <select name="version_id" class="form-select" required>
                    <option value="">-- Pilih Versi --</option>
                    @foreach ($versions as $v)
                        <option value="{{ $v->id }}" {{ $selectedVersion == $v->id ? 'selected' : '' }}>{{ $v->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select name="guru_id" class="form-select" required>
                    <option value="">-- Pilih Guru --</option>
                    @foreach ($gurus as $g)
                        <option value="{{ $g->id }}" {{ $selectedGuru == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="ti ti-eye"></i> Lihat</button>
            </div>
        </form>

        @if($selectedGuru && $selectedVersion)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="bg-light">Jam</th>
                        @foreach ($hariList as $hari)
                            <th class="bg-light text-center">{{ $hari->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jamList as $jam)
                    <tr>
                        <td class="fw-bold bg-light">{{ $jam->nama }}</td>
                        @foreach ($hariList as $hari)
                            @php
                                $entry = $jadwal->where('hari_id', $hari->id)->where('jam_id', $jam->id)->first();
                            @endphp
                            <td class="text-center">
                                @if ($entry)
                                    <div class="fw-bold">{{ $entry->mataPelajaran->nama }}</div>
                                    <div>{{ $entry->kelas->nama }}</div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('select[name=version_id], select[name=guru_id]').on('change', function(){
        if($('select[name=version_id]').val() && $('select[name=guru_id]').val()){
            $(this).closest('form').submit();
        }
    });
});
</script>
@endpush
