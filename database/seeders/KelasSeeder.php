<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $tkj = Jurusan::where('kode', 'TKJ')->first()->id;
        $mplb = Jurusan::where('kode', 'MPLB')->first()->id;
        $tsm = Jurusan::where('kode', 'TSM')->first()->id;
        $akl = Jurusan::where('kode', 'AKL')->first()->id;

        $data = [
            ['nama' => 'X TKJ', 'tingkat' => '10', 'jurusan_id' => $tkj],
            ['nama' => 'XI TKJ', 'tingkat' => '11', 'jurusan_id' => $tkj],
            ['nama' => 'XII TKJ-1', 'tingkat' => '12', 'jurusan_id' => $tkj],
            ['nama' => 'XII TKJ-2', 'tingkat' => '12', 'jurusan_id' => $tkj],
            ['nama' => 'X MPLB', 'tingkat' => '10', 'jurusan_id' => $mplb],
            ['nama' => 'XI MPLB', 'tingkat' => '11', 'jurusan_id' => $mplb],
            ['nama' => 'X TSM', 'tingkat' => '10', 'jurusan_id' => $tsm],
            ['nama' => 'XI TSM', 'tingkat' => '11', 'jurusan_id' => $tsm],
            ['nama' => 'XII TSM', 'tingkat' => '12', 'jurusan_id' => $tsm],
            ['nama' => 'X AKL', 'tingkat' => '10', 'jurusan_id' => $akl],
        ];
        foreach ($data as $item) {
            Kelas::create($item);
        }
    }
}
