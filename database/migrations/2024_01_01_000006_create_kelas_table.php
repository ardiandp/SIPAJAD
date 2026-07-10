<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->enum('tingkat', ['10', '11', '12']);
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->nullOnDelete();
            $table->foreignId('wali_kelas_id')->nullable()->constrained('gurus')->nullOnDelete();
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
