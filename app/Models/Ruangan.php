<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruangan extends Model
{
    protected $fillable = ['nama', 'kapasitas', 'jenis', 'keterangan'];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
