<?php

namespace Database\Seeders;

use App\Models\BebanMengajar;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class BebanAjarSeeder extends Seeder
{
    public function run(): void
    {
        $g = Guru::pluck('id')->toArray();
        $m = MataPelajaran::pluck('id', 'kode')->toArray();
        $k = Kelas::pluck('id', 'nama')->toArray();

        // Mapping: [guru_index, mapel_kode, [kelas_nama => jp, ...]]
        $data = [
            // Guru 0: H. Ahmad Fauzi - BTA di X TKJ, X MPLB, X TSM = 6
            [0, 'BTA', ['X TKJ' => 2, 'X MPLB' => 2, 'X TSM' => 2]],
            // Guru 1: Siti Nurhaliza - PABP di semua kelas = 26
            [1, 'PABP', ['X TKJ' => 2, 'XI TKJ' => 3, 'XII TKJ-1' => 3, 'XII TKJ-2' => 3, 'X MPLB' => 2, 'XI MPLB' => 3, 'X TSM' => 2, 'XI TSM' => 3, 'XII TSM' => 3, 'X AKL' => 2]],
            // Guru 2: Hj. Maryam - BTA di X TKJ, XII TKJ-1, XII TKJ-2, X MPLB, X TSM, XII TSM = 14
            [2, 'BTA', ['X TKJ' => 2, 'XII TKJ-1' => 2, 'XII TKJ-2' => 2, 'X MPLB' => 2, 'X TSM' => 2, 'XII TSM' => 2]],
            // Guru 3: Bambang - BINDO di X TKJ, XI TKJ, XII TKJ-1, X MPLB, X TSM, XI TSM = 18
            [3, 'BINDO', ['X TKJ' => 3, 'XI TKJ' => 3, 'XII TKJ-1' => 3, 'X MPLB' => 3, 'X TSM' => 3, 'XI TSM' => 3]],
            // Guru 4: Sulistyo - MTK di semua = 34
            [4, 'MTK', ['X TKJ' => 4, 'XI TKJ' => 3, 'XII TKJ-1' => 3, 'XII TKJ-2' => 3, 'X MPLB' => 4, 'XI MPLB' => 3, 'X TSM' => 4, 'XI TSM' => 3, 'XII TSM' => 3, 'X AKL' => 4]],
            // Guru 5: Rina Marlina - SJRH di X TKJ, X MPLB, X TSM, X AKL = 8
            [5, 'SJRH', ['X TKJ' => 2, 'X MPLB' => 2, 'X TSM' => 2, 'X AKL' => 2]],
            // Guru 6: Dwi Handayani - BINDO di XII TKJ-2, XI MPLB, XII TSM = 12
            [6, 'BINDO', ['XII TKJ-2' => 3, 'XI MPLB' => 3, 'XII TSM' => 3, 'X AKL' => 3]],
            // Guru 7: Asep Kurniawan - INF di X TKJ, X MPLB, X TSM, X AKL = 16
            [7, 'INF', ['X TKJ' => 4, 'X MPLB' => 4, 'X TSM' => 4, 'X AKL' => 4]],
            // Guru 8: Eko Prasetyo - SJRH di XI TKJ, XI MPLB, XI TSM = 6
            [8, 'SJRH', ['XI TKJ' => 2, 'XI MPLB' => 2, 'XI TSM' => 2]],
            // Guru 9: Nina Marlina - BING di semua = 40
            [9, 'BING', ['X TKJ' => 4, 'XI TKJ' => 4, 'XII TKJ-1' => 4, 'XII TKJ-2' => 4, 'X MPLB' => 4, 'XI MPLB' => 4, 'X TSM' => 4, 'XI TSM' => 4, 'XII TSM' => 4, 'X AKL' => 4]],
            // Guru 10: Ahmad Rifa'i - SB di X TKJ, X MPLB, X TSM, X AKL = 8
            [10, 'SB', ['X TKJ' => 2, 'X MPLB' => 2, 'X TSM' => 2, 'X AKL' => 2]],
            // Guru 11: Rudi Hartono - PKK di XII TKJ-1, XII TKJ-2, XI MPLB, XII TSM = 15
            [11, 'PKK', ['XII TKJ-1' => 5, 'XII TKJ-2' => 5, 'XII TSM' => 5]],
            // Guru 12: Syamsul Maarif - PJOK di X TKJ, XI TKJ, X MPLB, XI MPLB, X TSM, XII TSM = 18
            [12, 'PJOK', ['X TKJ' => 3, 'XI TKJ' => 2, 'X MPLB' => 3, 'XI MPLB' => 2, 'X TSM' => 3, 'XII TSM' => 2, 'X AKL' => 3]],
            // Guru 13: Yuni Astuti - PPKN di XI TKJ, XI MPLB, XI TSM = 6
            [13, 'PPKN', ['XI TKJ' => 2, 'XI MPLB' => 2, 'XI TSM' => 2]],
            // Guru 14: Indra Lesmana - PPKN di XII TKJ-1, XII TKJ-2, XII TSM = 6
            [14, 'PPKN', ['XII TKJ-1' => 2, 'XII TKJ-2' => 2, 'XII TSM' => 2]],
            // Guru 15: Fitriani - PPKN di X TKJ, X MPLB, X TSM, X AKL = 8
            [15, 'PPKN', ['X TKJ' => 2, 'X MPLB' => 2, 'X TSM' => 2, 'X AKL' => 2]],
            // Guru 16: Dewi Sartika - IPAS di X TKJ, X MPLB, X TSM, X AKL = 24
            [16, 'IPAS', ['X TKJ' => 6, 'X MPLB' => 6, 'X TSM' => 6, 'X AKL' => 6]],
            // Guru 17: Sumarno - DDK TSM = 12
            [17, 'DDK-TSM', ['X TSM' => 12]],
            // Guru 18: Hariyanto - PLSM-11 di XI TSM = 6
            [18, 'PLSM-11', ['XI TSM' => 6]],
            // Guru 19: Toni Susanto - DDK TKJ = 12
            [19, 'DDK-TKJ', ['X TKJ' => 12]],
            // Guru 20: Rizki Amalia - Coding di X TKJ, X MPLB, X TSM, X AKL = 8
            [20, 'Coding', ['X TKJ' => 2, 'X MPLB' => 2, 'X TSM' => 2, 'X AKL' => 2]],
            // Guru 21: Joko Widodo - PPJ-11 di XI TKJ = 6
            [21, 'PPJ-11', ['XI TKJ' => 6]],
            // Guru 22: Nurhayati - DDK MPLB = 12
            [22, 'DDK-MPLB', ['X MPLB' => 12]],
            // Guru 23: Agus Salim - PKK di X TKJ, X MPLB, X TSM = 15
            [23, 'PKK', ['X TKJ' => 5, 'X MPLB' => 5, 'X TSM' => 5]],
            // Guru 24: Siti Rahmawati - PRD-MPLB
            [24, 'PRD-MPLB', ['XI MPLB' => 6]],
            // Guru 25: Rina Wijaya - PRD-MPLB
            [25, 'PRD-MPLB', ['XI MPLB' => 6]],
            // Guru 26: Sari Indah - PRD-MPLB
            [26, 'PRD-MPLB', ['XI MPLB' => 6]],
            // Guru 27: Hasan Basri - DDK AKL = 12
            [27, 'DDK-AKL', ['X AKL' => 12]],
            // Guru 28: Deni Setiawan - KJ-11 di XI TKJ = 6
            [28, 'KJ-11', ['XI TKJ' => 6]],
            // Guru 29: Citra Dewi - TJKN-11 di XI TKJ = 6
            [29, 'TJKN-11', ['XI TKJ' => 6]],
            // Guru 30: Bayu Pratama - Coding di XI TKJ, XII TKJ-1, XII TKJ-2, XI MPLB, XI TSM, XII TSM = 24
            [30, 'Coding', ['XI TKJ' => 4, 'XII TKJ-1' => 4, 'XII TKJ-2' => 4, 'XI MPLB' => 4, 'XI TSM' => 4, 'XII TSM' => 4]],
            // Guru 31: Rudi Hermawan - ASJ-12 di XII TKJ-1, XII TKJ-2 = 16
            [31, 'ASJ-12', ['XII TKJ-1' => 8, 'XII TKJ-2' => 8]],
            // Guru 32: Slamet Riyadi - PPJ-12 di XII TKJ-1, XII TKJ-2 = 14
            [32, 'PPJ-12', ['XII TKJ-1' => 7, 'XII TKJ-2' => 7]],
            // Guru 33: Andi Saputra - PKPP-12 di XII TKJ-1, XII TKJ-2 = 14
            [33, 'PKPP-12', ['XII TKJ-1' => 7, 'XII TKJ-2' => 7]],
            // Guru 34: Mulyadi - PBSM-12 di XII TSM = 8
            [34, 'PBSM-12', ['XII TSM' => 8]],
            // Guru 35: Edi Santoso - PMSM di XI TSM, XII TSM = 13
            [35, 'PMSM', ['XI TSM' => 6, 'XII TSM' => 7]],
            // Guru 36: Sutrisno - PSSM-11 di XI TSM = 6
            [36, 'PSSM-11', ['XI TSM' => 6]],
            // Guru 37: Rohmat - PSSM-12 di XII TSM = 7
            [37, 'PSSM-12', ['XII TSM' => 7]],
        ];

        foreach ($data as $item) {
            [$guruIdx, $mapelKode, $kelasList] = $item;
            foreach ($kelasList as $kelasNama => $jp) {
                BebanMengajar::create([
                    'guru_id' => $g[$guruIdx],
                    'mata_pelajaran_id' => $m[$mapelKode],
                    'kelas_id' => $k[$kelasNama],
                    'jumlah_jam' => $jp,
                ]);
            }
        }
    }
}
