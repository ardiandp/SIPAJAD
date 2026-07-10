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
        set_time_limit(300);

        $data = [
            'gurus' => Guru::where('status', 'aktif')->get(['id', 'maks_jam'])->toArray(),
            'mapels' => MataPelajaran::all(['id', 'nama', 'kode', 'durasi', 'jam_per_minggu', 'jenis'])->toArray(),
            'kelas' => Kelas::all(['id'])->toArray(),
            'ruangans' => Ruangan::all(['id'])->toArray(),
            'hari' => Hari::orderBy('urutan')->get(['id'])->toArray(),
            'jam' => Jam::orderBy('urutan')->get(['id', 'nama'])->toArray(),
            'bebans' => BebanMengajar::get()->map(fn($b) => [
                'guru_id' => $b->guru_id,
                'mapel_id' => $b->mata_pelajaran_id,
                'kelas_id' => $b->kelas_id,
                'jumlah_jam' => $b->jumlah_jam,
            ])->toArray(),
        ];

        try {
            $response = Http::timeout(300)->post('http://127.0.0.1:5000/api/generate', $data);
        } catch (\Exception $e) {
            return redirect()->route('jadwal.versi')->with('error', 'Gagal terhubung ke Python scheduler. Pastikan python/app.py sudah dijalankan. Error: ' . $e->getMessage());
        }

        if (!$response->successful()) {
            return redirect()->route('jadwal.versi')->with('error', 'Python scheduler error: ' . $response->body());
        }

        $result = $response->json();

        if ($result['status'] !== 'success') {
            return redirect()->route('jadwal.versi')->with('error', $result['message'] ?? 'Gagal generate jadwal');
        }

        Jadwal::where('schedule_version_id', $scheduleVersion->id)->delete();

        $chunks = array_chunk($result['jadwal'], 50);
        foreach ($chunks as $chunk) {
            $insertData = [];
            foreach ($chunk as $item) {
                $insertData[] = array_merge($item, [
                    'schedule_version_id' => $scheduleVersion->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Jadwal::insert($insertData);
        }

        $total = count($result['jadwal']);
        $scheduleVersion->update(['status' => 'draft']);

        return redirect()->route('jadwal.keseluruhan', ['version_id' => $scheduleVersion->id])
            ->with('success', "Jadwal berhasil digenerate! Total: {$total} entri.");
    }

    public function finalize(ScheduleVersion $scheduleVersion)
    {
        $scheduleVersion->update(['status' => 'final']);
        return redirect()->route('jadwal.versi')->with('success', 'Versi jadwal di-finalkan');
    }

    public function destroy(ScheduleVersion $scheduleVersion)
    {
        $scheduleVersion->delete();
        return redirect()->route('jadwal.versi')->with('success', 'Versi jadwal dihapus');
    }
}
