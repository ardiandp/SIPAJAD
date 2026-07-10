<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = [
        'kode', 'nama', 'kelompok', 'durasi', 'jam_per_minggu', 'jenis'
    ];

    public function bebanMengajar(): HasMany
    {
        return $this->hasMany(BebanMengajar::class);
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
