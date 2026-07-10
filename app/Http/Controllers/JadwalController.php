<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\ScheduleVersion;
use App\Models\Hari;
use App\Models\Jam;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function keseluruhan(Request $request)
    {
        $versions = ScheduleVersion::where('status', 'final')->orWhere('status', 'draft')->orderBy('created_at', 'desc')->get();
        $kelasAll = Kelas::with('jurusan')->orderBy('tingkat')->orderBy('jurusan_id')->get();
        $selectedVersion = $request->get('version_id');
        $selectedKelas = $request->get('kelas_id');

        if (!$selectedVersion && $versions->isNotEmpty()) {
            $selectedVersion = $versions->first()->id;
        }
        if (!$selectedKelas && $kelasAll->isNotEmpty()) {
            $selectedKelas = $kelasAll->first()->id;
        }

        $version = ScheduleVersion::find($selectedVersion);
        $hariList = Hari::orderBy('urutan')->get();
        $jamList = Jam::orderBy('urutan')->get();

        $jadwal = collect();
        $totalEntri = 0;
        $totalGuru = 0;
        $totalJP = 0;
        $totalKelasTerisi = 0;

        if ($selectedVersion) {
            $query = Jadwal::with(['guru', 'mataPelajaran', 'hari', 'jam', 'ruangan', 'kelas.jurusan'])
                ->where('schedule_version_id', $selectedVersion);

            if ($selectedKelas) {
                $query->where('kelas_id', $selectedKelas);
            }

            $jadwal = $query->get();
            $totalEntri = $jadwal->count();
            $totalGuru = $jadwal->pluck('guru_id')->unique()->count();
            $totalJP = $jadwal->count();
            $totalKelasTerisi = $jadwal->pluck('kelas_id')->unique()->count();
        }

        return view('jadwal.keseluruhan', compact(
            'versions', 'kelasAll', 'selectedVersion', 'selectedKelas',
            'version', 'hariList', 'jamList', 'jadwal',
            'totalEntri', 'totalGuru', 'totalJP', 'totalKelasTerisi'
        ));
    }

    public function byKelas(Request $request)
    {
        $kelas = Kelas::with('jurusan')->get();
        $versions = ScheduleVersion::where('status', 'final')->orWhere('status', 'draft')->get();
        $selectedKelas = $request->get('kelas_id');
        $selectedVersion = $request->get('version_id');

        $jadwal = collect();
        $hariList = Hari::orderBy('urutan')->get();
        $jamList = Jam::orderBy('urutan')->get();

        if ($selectedKelas && $selectedVersion) {
            $jadwal = Jadwal::with(['guru', 'mataPelajaran', 'hari', 'jam', 'ruangan'])
                ->where('kelas_id', $selectedKelas)
                ->where('schedule_version_id', $selectedVersion)
                ->get();
        }

        return view('jadwal.perkelas', compact(
            'kelas', 'versions', 'selectedKelas', 'selectedVersion',
            'jadwal', 'hariList', 'jamList'
        ));
    }

    public function byGuru(Request $request)
    {
        $gurus = Guru::where('status', 'aktif')->get();
        $versions = ScheduleVersion::where('status', 'final')->orWhere('status', 'draft')->get();
        $selectedGuru = $request->get('guru_id');
        $selectedVersion = $request->get('version_id');

        $jadwal = collect();
        $hariList = Hari::orderBy('urutan')->get();
        $jamList = Jam::orderBy('urutan')->get();

        if ($selectedGuru && $selectedVersion) {
            $jadwal = Jadwal::with(['kelas', 'mataPelajaran', 'hari', 'jam', 'ruangan'])
                ->where('guru_id', $selectedGuru)
                ->where('schedule_version_id', $selectedVersion)
                ->get();
        }

        return view('jadwal.perguru', compact(
            'gurus', 'versions', 'selectedGuru', 'selectedVersion',
            'jadwal', 'hariList', 'jamList'
        ));
    }

    public function byRuangan(Request $request)
    {
        $ruangans = Ruangan::all();
        $versions = ScheduleVersion::where('status', 'final')->orWhere('status', 'draft')->get();
        $selectedRuangan = $request->get('ruangan_id');
        $selectedVersion = $request->get('version_id');

        $jadwal = collect();
        $hariList = Hari::orderBy('urutan')->get();
        $jamList = Jam::orderBy('urutan')->get();

        if ($selectedRuangan && $selectedVersion) {
            $jadwal = Jadwal::with(['guru', 'mataPelajaran', 'kelas', 'hari', 'jam'])
                ->where('ruangan_id', $selectedRuangan)
                ->where('schedule_version_id', $selectedVersion)
                ->get();
        }

        return view('jadwal.perruangan', compact(
            'ruangans', 'versions', 'selectedRuangan', 'selectedVersion',
            'jadwal', 'hariList', 'jamList'
        ));
    }
}
