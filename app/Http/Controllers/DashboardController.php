<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\ScheduleVersion;
use App\Models\BebanMengajar;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_guru' => Guru::count(),
            'total_mapel' => MataPelajaran::count(),
            'total_kelas' => Kelas::count(),
            'total_ruangan' => Ruangan::count(),
            'total_beban' => BebanMengajar::count(),
            'total_versi' => ScheduleVersion::count(),
            'jadwal_final' => ScheduleVersion::where('status', 'final')->count(),
        ];
        return view('dashboard', compact('data'));
    }
}
