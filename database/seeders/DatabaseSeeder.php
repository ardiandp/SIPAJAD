<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hari;
use App\Models\Jam;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kurikulum@admin.com'],
            [
                'name' => 'Waka Kurikulum',
                'email' => 'kurikulum@admin.com',
                'password' => bcrypt('password'),
                'role' => 'kurikulum',
            ]
        );

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        foreach ($hariList as $i => $nama) {
            Hari::firstOrCreate(['urutan' => $i + 1], ['nama' => $nama, 'urutan' => $i + 1]);
        }

        $jamData = [
            ['nama' => 'Jam ke-1', 'waktu_mulai' => '07:00', 'waktu_selesai' => '07:45', 'urutan' => 1],
            ['nama' => 'Jam ke-2', 'waktu_mulai' => '07:45', 'waktu_selesai' => '08:30', 'urutan' => 2],
            ['nama' => 'Jam ke-3', 'waktu_mulai' => '08:30', 'waktu_selesai' => '09:15', 'urutan' => 3],
            ['nama' => 'Istirahat 1', 'waktu_mulai' => '09:15', 'waktu_selesai' => '09:30', 'urutan' => 4],
            ['nama' => 'Jam ke-4', 'waktu_mulai' => '09:30', 'waktu_selesai' => '10:15', 'urutan' => 5],
            ['nama' => 'Jam ke-5', 'waktu_mulai' => '10:15', 'waktu_selesai' => '11:00', 'urutan' => 6],
            ['nama' => 'Jam ke-6', 'waktu_mulai' => '11:00', 'waktu_selesai' => '11:45', 'urutan' => 7],
            ['nama' => 'Jam ke-7', 'waktu_mulai' => '11:45', 'waktu_selesai' => '12:30', 'urutan' => 8],
            ['nama' => 'Istirahat 2', 'waktu_mulai' => '12:30', 'waktu_selesai' => '13:00', 'urutan' => 9],
            ['nama' => 'Jam ke-8', 'waktu_mulai' => '13:00', 'waktu_selesai' => '13:45', 'urutan' => 10],
            ['nama' => 'Jam ke-9', 'waktu_mulai' => '13:45', 'waktu_selesai' => '14:30', 'urutan' => 11],
        ];
        foreach ($jamData as $data) {
            Jam::firstOrCreate(['urutan' => $data['urutan']], $data);
        }

        $ruangData = [
            ['nama' => 'R. Kelas 1', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 2', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 3', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 4', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 5', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 6', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 7', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 8', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 9', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'R. Kelas 10', 'kapasitas' => 36, 'jenis' => 'kelas'],
            ['nama' => 'Lab. Komputer 1', 'kapasitas' => 40, 'jenis' => 'laboratorium'],
            ['nama' => 'Lab. Komputer 2', 'kapasitas' => 40, 'jenis' => 'laboratorium'],
            ['nama' => 'Lab. Akuntansi', 'kapasitas' => 40, 'jenis' => 'laboratorium'],
            ['nama' => 'Lab. Bahasa', 'kapasitas' => 30, 'jenis' => 'laboratorium'],
            ['nama' => 'Bengkel TSM', 'kapasitas' => 30, 'jenis' => 'bengkel'],
            ['nama' => 'Aula', 'kapasitas' => 200, 'jenis' => 'aula'],
            ['nama' => 'Perpustakaan', 'kapasitas' => 50, 'jenis' => 'lainnya'],
        ];
        foreach ($ruangData as $data) {
            Ruangan::firstOrCreate(['nama' => $data['nama']], $data);
        }

        $this->call([
            JurusanSeeder::class,
            GuruSeeder::class,
            MapelSeeder::class,
            KelasSeeder::class,
            BebanAjarSeeder::class,
        ]);
    }
}
