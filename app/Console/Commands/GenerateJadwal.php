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
use Illuminate\Support\Facades\Cache;

class GenerateJadwal extends Command
{
    protected $signature = 'jadwal:generate {version_id}';
    protected $description = 'Generate jadwal otomatis menggunakan Python OR-Tools';

    private function setProgress($versionId, $percent, $step, $message)
    {
        Cache::put("generate_progress_{$versionId}", [
            'percent' => $percent,
            'step' => $step,
            'message' => $message,
            'done' => false,
            'error' => false,
        ], 600);
    }

    private function setError($versionId, $message)
    {
        Cache::put("generate_progress_{$versionId}", [
            'percent' => 100,
            'step' => 'error',
            'message' => $message,
            'done' => true,
            'error' => true,
        ], 600);
    }

    private function setDone($versionId, $total)
    {
        Cache::put("generate_progress_{$versionId}", [
            'percent' => 100,
            'step' => 'selesai',
            'message' => "Jadwal berhasil digenerate! Total: {$total} entri.",
            'done' => true,
            'error' => false,
            'total' => $total,
        ], 600);
    }

    public function handle()
    {
        $versionId = $this->argument('version_id');
        $version = ScheduleVersion::findOrFail($versionId);

        $this->setProgress($versionId, 5, 'mulai', 'Memulai proses generate...');

        $this->setProgress($versionId, 10, 'data', 'Mengumpulkan data master...');
        $this->info('Mengumpulkan data...');

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

        $this->setProgress($versionId, 30, 'kirim', 'Mengirim data ke Python scheduler...');
        $this->info('Mengirim ke Python scheduler...');

        try {
            $this->setProgress($versionId, 40, 'tunggu', 'Menunggu hasil OR-Tools (bisa 30-120 detik)...');
            $response = Http::timeout(300)->post('http://127.0.0.1:5000/api/generate', $data);
        } catch (\Exception $e) {
            $this->setError($versionId, 'Gagal terhubung ke Python scheduler. Pastikan python/app.py sudah dijalankan.');
            $this->error('Gagal: ' . $e->getMessage());
            return 1;
        }

        if (!$response->successful()) {
            $this->setError($versionId, 'Python scheduler error: ' . $response->body());
            $this->error('Gagal: ' . $response->body());
            return 1;
        }

        $result = $response->json();

        if ($result['status'] !== 'success') {
            $this->setError($versionId, $result['message'] ?? 'Gagal generate jadwal');
            $this->error($result['message'] ?? 'Gagal generate jadwal');
            return 1;
        }

        $this->setProgress($versionId, 80, 'simpan', 'Menyimpan jadwal ke database...');
        $this->info('Menyimpan jadwal...');

        Jadwal::where('schedule_version_id', $versionId)->delete();

        $chunks = array_chunk($result['jadwal'], 50);
        foreach ($chunks as $chunk) {
            $insertData = [];
            foreach ($chunk as $item) {
                $insertData[] = array_merge($item, [
                    'schedule_version_id' => $versionId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Jadwal::insert($insertData);
        }

        $total = count($result['jadwal']);

        $this->setProgress($versionId, 95, 'selesai', 'Proses selesai! Total: ' . $total . ' entri jadwal.');
        $this->info('Jadwal berhasil digenerate!');

        sleep(1);
        $this->setDone($versionId, $total);

        return 0;
    }
}
