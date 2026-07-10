<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guru extends Model
{
    protected $fillable = [
        'nip', 'nama', 'gender', 'no_hp', 'status',
        'bidang', 'maks_jam', 'preferensi_hari', 'preferensi_jam'
    ];

    protected $casts = [
        'preferensi_hari' => 'array',
        'preferensi_jam' => 'array',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function bebanMengajar(): HasMany
    {
        return $this->hasMany(BebanMengajar::class);
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }

    public function waliKelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
