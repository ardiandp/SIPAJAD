<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hari extends Model
{
    protected $table = 'hari';

    protected $fillable = ['nama', 'urutan'];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
