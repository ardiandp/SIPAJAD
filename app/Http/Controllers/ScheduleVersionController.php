<?php

namespace App\Http\Controllers;

use App\Models\ScheduleVersion;
use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Hari;
use App\Models\Jam;
use App\Models\BebanMengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ScheduleVersionController extends Controller
{
    public function index()
    {
        $versions = ScheduleVersion::with('creator')->latest()->get();
        return view('jadwal.versi', compact('versions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
        ]);
        $validated['created_by'] = auth()->id();
        ScheduleVersion::create($validated);
        return redirect()->route('jadwal.versi')->with('success', 'Versi jadwal baru dibuat');
    }

    public function generate(ScheduleVersion $scheduleVersion)
    {
        $pidFile = storage_path("app/generate_{$scheduleVersion->id}.pid");

        if (file_exists($pidFile)) {
            return redirect()->route('jadwal.progress', $scheduleVersion->id)
                ->with('info', 'Proses generate sedang berjalan...');
        }

        Cache::put("generate_progress_{$scheduleVersion->id}", [
            'percent' => 0,
            'step' => 'mulai',
            'message' => 'Memulai proses generate...',
            'done' => false,
            'error' => false,
        ], 600);

        $artisanPath = base_path('artisan');
        $phpPath = PHP_BINARY;

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $cmd = "start /B \"\" \"{$phpPath}\" \"{$artisanPath}\" jadwal:generate {$scheduleVersion->id} > NUL 2>&1";
            exec($cmd);
        } else {
            $cmd = "nohup \"{$phpPath}\" \"{$artisanPath}\" jadwal:generate {$scheduleVersion->id} > /dev/null 2>&1 & echo $!";
            $pid = exec($cmd);
            file_put_contents($pidFile, $pid);
        }

        return redirect()->route('jadwal.progress', $scheduleVersion->id);
    }

    public function progress($versionId)
    {
        $version = ScheduleVersion::findOrFail($versionId);
        return view('jadwal.progress', compact('version'));
    }

    public function progressData($versionId)
    {
        $progress = Cache::get("generate_progress_{$versionId}", [
            'percent' => 0,
            'step' => 'mulai',
            'message' => 'Memulai...',
            'done' => false,
            'error' => false,
        ]);

        return response()->json($progress);
    }

    public function finalize(ScheduleVersion $scheduleVersion)
    {
        $scheduleVersion->update(['status' => 'final']);
        return redirect()->route('jadwal.versi')->with('success', 'Versi jadwal di-finalkan');
    }

    public function destroy(ScheduleVersion $scheduleVersion)
    {
        $pidFile = storage_path("app/generate_{$scheduleVersion->id}.pid");
        if (file_exists($pidFile)) {
            unlink($pidFile);
        }
        Cache::forget("generate_progress_{$scheduleVersion->id}");
        $scheduleVersion->delete();
        return redirect()->route('jadwal.versi')->with('success', 'Versi jadwal dihapus');
    }
}
