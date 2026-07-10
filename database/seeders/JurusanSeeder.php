<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'TKJ', 'nama' => 'Teknik Komputer dan Jaringan', 'keterangan' => 'Bidang Keahlian Teknologi Informasi'],
            ['kode' => 'MPLB', 'nama' => 'Manajemen Perkantoran dan Layanan Bisnis', 'keterangan' => 'Bidang Keahlian Manajemen Bisnis'],
            ['kode' => 'TSM', 'nama' => 'Teknik Sepeda Motor', 'keterangan' => 'Bidang Keahlian Teknik Otomotif'],
            ['kode' => 'AKL', 'nama' => 'Akuntansi dan Keuangan Lembaga', 'keterangan' => 'Bidang Keahlian Akuntansi'],
        ];
        foreach ($data as $item) {
            Jurusan::create($item);
        }
    }
}
