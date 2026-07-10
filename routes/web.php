<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\HariController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\BebanMengajarController;
use App\Http\Controllers\ScheduleVersionController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('jurusan', JurusanController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('mapel', MataPelajaranController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('hari', HariController::class);
        Route::resource('jam', JamController::class);
        Route::resource('beban', BebanMengajarController::class);
        Route::get('beban/by-guru/{guru}', [BebanMengajarController::class, 'byGuru'])->name('beban.by-guru');
    });

    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('keseluruhan', [JadwalController::class, 'keseluruhan'])->name('keseluruhan');

        Route::get('versi', [ScheduleVersionController::class, 'index'])->name('versi');
        Route::post('versi', [ScheduleVersionController::class, 'store'])->name('versi.store');
        Route::post('versi/{scheduleVersion}/generate', [ScheduleVersionController::class, 'generate'])->name('versi.generate');
        Route::patch('versi/{scheduleVersion}/finalize', [ScheduleVersionController::class, 'finalize'])->name('versi.finalize');
        Route::delete('versi/{scheduleVersion}', [ScheduleVersionController::class, 'destroy'])->name('versi.destroy');

        Route::get('kelas', [JadwalController::class, 'byKelas'])->name('kelas');
        Route::get('guru', [JadwalController::class, 'byGuru'])->name('guru');
        Route::get('ruangan', [JadwalController::class, 'byRuangan'])->name('ruangan');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
