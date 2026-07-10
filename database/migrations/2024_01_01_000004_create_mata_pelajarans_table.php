<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();
            $table->string('nama', 100);
            $table->enum('kelompok', ['A', 'B', 'C'])->default('C');
            $table->integer('durasi')->default(45);
            $table->integer('jam_per_minggu')->default(2);
            $table->enum('jenis', ['teori', 'praktikum'])->default('teori');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
