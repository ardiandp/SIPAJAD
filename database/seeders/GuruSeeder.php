<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nip' => '197001012005011001', 'nama' => 'H. Ahmad Fauzi, S.Ag', 'gender' => 'L', 'bidang' => 'Pendidikan Agama'],
            ['nip' => '197202122006042002', 'nama' => 'Dra. Siti Nurhaliza', 'gender' => 'P', 'bidang' => 'Pendidikan Agama'],
            ['nip' => '196803052007011003', 'nama' => 'Hj. Maryam, S.Ag', 'gender' => 'P', 'bidang' => 'Pendidikan Agama'],
            ['nip' => '198005102009021004', 'nama' => 'Drs. Bambang Suprayitno', 'gender' => 'L', 'bidang' => 'Bahasa Indonesia'],
            ['nip' => '198107122010031005', 'nama' => 'Sulistyo, S.Pd', 'gender' => 'L', 'bidang' => 'Matematika'],
            ['nip' => '198208142011042006', 'nama' => 'Rina Marlina, S.Pd', 'gender' => 'P', 'bidang' => 'Sejarah'],
            ['nip' => '198309162012051007', 'nama' => 'Dwi Handayani, S.Pd', 'gender' => 'P', 'bidang' => 'Bahasa Indonesia'],
            ['nip' => '198410182013062008', 'nama' => 'Asep Kurniawan, S.Kom', 'gender' => 'L', 'bidang' => 'Informatika'],
            ['nip' => '198511202014071009', 'nama' => 'Eko Prasetyo, S.Pd', 'gender' => 'L', 'bidang' => 'Sejarah'],
            ['nip' => '198612222015082010', 'nama' => 'Dra. Nina Marlina, M.Pd', 'gender' => 'P', 'bidang' => 'Bahasa Inggris'],
            ['nip' => '198701242016091011', 'nama' => 'Ahmad Rifa\'i, S.Sn', 'gender' => 'L', 'bidang' => 'Seni Budaya'],
            ['nip' => '198802262017102012', 'nama' => 'Rudi Hartono, S.Pd', 'gender' => 'L', 'bidang' => 'Kewirausahaan'],
            ['nip' => '198903282018111013', 'nama' => 'Drs. H. Syamsul Maarif', 'gender' => 'L', 'bidang' => 'PJOK'],
            ['nip' => '199004302019122014', 'nama' => 'Yuni Astuti, S.Pd', 'gender' => 'P', 'bidang' => 'PPKn'],
            ['nip' => '199106012020011015', 'nama' => 'Indra Lesmana, S.Pd', 'gender' => 'L', 'bidang' => 'PPKn'],
            ['nip' => '199207032021022016', 'nama' => 'Fitriani, S.Pd', 'gender' => 'P', 'bidang' => 'PPKn'],
            ['nip' => '199308052022033017', 'nama' => 'Dewi Sartika, S.Pd', 'gender' => 'P', 'bidang' => 'IPAS'],
            ['nip' => '199409072023044018', 'nama' => 'H. Sumarno, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
            ['nip' => '199510092024055019', 'nama' => 'Hariyanto, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
            ['nip' => '199611112025066020', 'nama' => 'Toni Susanto, S.Kom', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '199701132027077021', 'nama' => 'Rizki Amalia, S.Kom', 'gender' => 'P', 'bidang' => 'Teknik Komputer'],
            ['nip' => '199802152028088022', 'nama' => 'Joko Widodo, S.T', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '199903172029099023', 'nama' => 'Nurhayati, S.Pd', 'gender' => 'P', 'bidang' => 'Administrasi Perkantoran'],
            ['nip' => '200004192030100024', 'nama' => 'Agus Salim, S.Pd', 'gender' => 'L', 'bidang' => 'Kewirausahaan'],
            ['nip' => '200105212031111025', 'nama' => 'Siti Rahmawati, S.Pd', 'gender' => 'P', 'bidang' => 'Administrasi Perkantoran'],
            ['nip' => '200206232032122026', 'nama' => 'Rina Wijaya, S.E', 'gender' => 'P', 'bidang' => 'Administrasi Perkantoran'],
            ['nip' => '200307252033133027', 'nama' => 'Sari Indah, S.Pd', 'gender' => 'P', 'bidang' => 'Administrasi Perkantoran'],
            ['nip' => '200408272034144028', 'nama' => 'Drs. Hasan Basri', 'gender' => 'L', 'bidang' => 'Akuntansi'],
            ['nip' => '200509292035155029', 'nama' => 'Deni Setiawan, S.Kom', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '200610312036166030', 'nama' => 'Citra Dewi, S.Kom', 'gender' => 'P', 'bidang' => 'Teknik Komputer'],
            ['nip' => '200712022037177031', 'nama' => 'Bayu Pratama, S.Kom', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '200802042038188032', 'nama' => 'Rudi Hermawan, S.T', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '200903062039199033', 'nama' => 'Ir. Slamet Riyadi', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '201004082040200034', 'nama' => 'Andi Saputra, S.T', 'gender' => 'L', 'bidang' => 'Teknik Komputer'],
            ['nip' => '201105102041211035', 'nama' => 'H. Mulyadi, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
            ['nip' => '201206122042222036', 'nama' => 'Edi Santoso, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
            ['nip' => '201307142043233037', 'nama' => 'Sutrisno, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
            ['nip' => '201408162044244038', 'nama' => 'Rohmat, S.T', 'gender' => 'L', 'bidang' => 'Teknik Otomotif'],
        ];
        foreach ($data as $item) {
            Guru::create($item);
        }
    }
}
