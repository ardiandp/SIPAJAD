<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jam extends Model
{
    protected $table = 'jam';

    protected $fillable = ['nama', 'waktu_mulai', 'waktu_selesai', 'urutan'];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
