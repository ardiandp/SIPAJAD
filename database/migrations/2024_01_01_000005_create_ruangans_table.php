<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->integer('kapasitas')->default(30);
            $table->enum('jenis', ['kelas', 'laboratorium', 'aula', 'bengkel', 'lainnya'])->default('kelas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
