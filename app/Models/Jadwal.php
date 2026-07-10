<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    protected $fillable = [
        'schedule_version_id', 'hari_id', 'jam_id',
        'guru_id', 'mata_pelajaran_id', 'kelas_id', 'ruangan_id'
    ];

    public function scheduleVersion(): BelongsTo
    {
        return $this->belongsTo(ScheduleVersion::class);
    }

    public function hari(): BelongsTo
    {
        return $this->belongsTo(Hari::class);
    }

    public function jam(): BelongsTo
    {
        return $this->belongsTo(Jam::class);
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class);
    }
}
