<?php

namespace App\Console\Commands;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Hari;
use App\Models\Jam;
use App\Models\BebanMengajar;
use App\Models\ScheduleVersion;
use App\Models\Jadwal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateJadwal extends Command
{
    protected $signature = 'jadwal:generate {version_id}';
    protected $description = 'Generate jadwal otomatis menggunakan Python OR-Tools';

    public function handle()
    {
        $versionId = $this->argument('version_id');
        $version = ScheduleVersion::findOrFail($versionId);

        $this->info('Mengumpulkan data...');

        $data = [
            'gurus' => Guru::where('status', 'aktif')->get(['id', 'maks_jam'])->toArray(),
            'mapels' => MataPelajaran::all(['id', 'durasi', 'jam_per_minggu'])->toArray(),
            'kelas' => Kelas::all(['id'])->toArray(),
            'ruangans' => Ruangan::all(['id'])->toArray(),
            'hari' => Hari::orderBy('urutan')->get(['id'])->toArray(),
            'jam' => Jam::orderBy('urutan')->get(['id'])->toArray(),
            'bebans' => BebanMengajar::with(['guru', 'mataPelajaran', 'kelas'])
                ->get()
                ->map(fn($b) => [
                    'guru_id' => $b->guru_id,
                    'mapel_id' => $b->mata_pelajaran_id,
                    'kelas_id' => $b->kelas_id,
                    'jumlah_jam' => $b->jumlah_jam,
                ])
                ->toArray(),
        ];

        $this->info('Mengirim ke Python scheduler...');

        $response = Http::timeout(120)->post('http://127.0.0.1:5000/api/generate', $data);

        if (!$response->successful()) {
            $this->error('Gagal: ' . $response->body());
            return 1;
        }

        $result = $response->json();

        if ($result['status'] !== 'success') {
            $this->error($result['message'] ?? 'Gagal generate jadwal');
            return 1;
        }

        $this->info('Menyimpan jadwal...');

        Jadwal::where('schedule_version_id', $versionId)->delete();

        foreach ($result['jadwal'] as $item) {
            Jadwal::create(array_merge($item, [
                'schedule_version_id' => $versionId,
            ]));
        }

        $this->info('Jadwal berhasil digenerate!');
        $this->info('Total: ' . count($result['jadwal']) . ' entri jadwal');

        return 0;
    }
}
