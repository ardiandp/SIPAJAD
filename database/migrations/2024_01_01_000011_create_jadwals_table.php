<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_version_id')->constrained('schedule_versions')->cascadeOnDelete();
            $table->foreignId('hari_id')->constrained('hari')->cascadeOnDelete();
            $table->foreignId('jam_id')->constrained('jam')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ruangan_id')->constrained('ruangans')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
