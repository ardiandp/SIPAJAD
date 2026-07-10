<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique()->nullable();
            $table->string('nama', 100);
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('bidang', 100)->nullable();
            $table->integer('maks_jam')->default(24);
            $table->text('preferensi_hari')->nullable();
            $table->text('preferensi_jam')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
