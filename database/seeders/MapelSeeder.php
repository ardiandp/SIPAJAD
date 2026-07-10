<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'BTA', 'nama' => 'Baca Tulis Al-Qur\'an', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 2, 'jenis' => 'teori'],
            ['kode' => 'PABP', 'nama' => 'Pendidikan Agama dan Budi Pekerti', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 3, 'jenis' => 'teori'],
            ['kode' => 'BINDO', 'nama' => 'Bahasa Indonesia', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 3, 'jenis' => 'teori'],
            ['kode' => 'MTK', 'nama' => 'Matematika', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 4, 'jenis' => 'teori'],
            ['kode' => 'SJRH', 'nama' => 'Sejarah Indonesia', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 2, 'jenis' => 'teori'],
            ['kode' => 'INF', 'nama' => 'Informatika', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 4, 'jenis' => 'teori'],
            ['kode' => 'BING', 'nama' => 'Bahasa Inggris', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 4, 'jenis' => 'teori'],
            ['kode' => 'SB', 'nama' => 'Seni Budaya', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 2, 'jenis' => 'teori'],
            ['kode' => 'PKK', 'nama' => 'Produk Kreatif dan Kewirausahaan', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 5, 'jenis' => 'teori'],
            ['kode' => 'PJOK', 'nama' => 'PJOK', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 3, 'jenis' => 'praktikum'],
            ['kode' => 'PPKN', 'nama' => 'Pendidikan Pancasila dan Kewarganegaraan', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 2, 'jenis' => 'teori'],
            ['kode' => 'IPAS', 'nama' => 'IPAS', 'kelompok' => 'A', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'teori'],
            ['kode' => 'DDK-TSM', 'nama' => 'Dasar-Dasar Kejuruan TSM', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 12, 'jenis' => 'teori'],
            ['kode' => 'PLSM-11', 'nama' => 'Pemeliharaan Listrik Sepeda Motor (Kelas 11)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'DDK-TKJ', 'nama' => 'Dasar-Dasar Kejuruan TKJ', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 12, 'jenis' => 'teori'],
            ['kode' => 'Coding', 'nama' => 'Coding dan Kecerdasan Artifisial', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 4, 'jenis' => 'praktikum'],
            ['kode' => 'PPJ-11', 'nama' => 'Perencanaan dan Pengalamatan Jaringan (Kelas 11)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'DDK-MPLB', 'nama' => 'Dasar-Dasar Kejuruan MPLB', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 12, 'jenis' => 'teori'],
            ['kode' => 'PRD-MPLB', 'nama' => 'Produktif MPLB', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'teori'],
            ['kode' => 'DDK-AKL', 'nama' => 'Dasar-Dasar Kejuruan Akuntansi', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 12, 'jenis' => 'teori'],
            ['kode' => 'KJ-11', 'nama' => 'Keamanan Jaringan (Kelas 11)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'TJKN-11', 'nama' => 'Teknologi Jaringan Kabel dan Nirkabel (Kelas 11)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'ASJ-12', 'nama' => 'Administrasi Sistem Jaringan (Kelas 12)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 8, 'jenis' => 'praktikum'],
            ['kode' => 'PPJ-12', 'nama' => 'Perencanaan dan Pengalamatan Jaringan (Kelas 12)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 7, 'jenis' => 'praktikum'],
            ['kode' => 'PKPP-12', 'nama' => 'Pemasangan dan Konfigurasi Perangkat Jaringan (Kelas 12)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 7, 'jenis' => 'praktikum'],
            ['kode' => 'PBSM-12', 'nama' => 'Pengelolaan Bengkel Sepeda Motor (Kelas 12)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 8, 'jenis' => 'praktikum'],
            ['kode' => 'PMSM', 'nama' => 'Pemeliharaan Mesin Sepeda Motor', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'PSSM-11', 'nama' => 'Pemeliharaan Sasis Sepeda Motor (Kelas 11)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 6, 'jenis' => 'praktikum'],
            ['kode' => 'PSSM-12', 'nama' => 'Pemeliharaan Sasis Sepeda Motor (Kelas 12)', 'kelompok' => 'C', 'durasi' => 45, 'jam_per_minggu' => 7, 'jenis' => 'praktikum'],
        ];
        foreach ($data as $item) {
            MataPelajaran::create($item);
        }
    }
}
