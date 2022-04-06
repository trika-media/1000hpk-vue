<?php

use App\Http\Controllers\Report\MahasiswaReportController;
use App\Http\Controllers\Report\IbuHamilReportController;
use App\Http\Controllers\Report\PenyakitReportController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN UNTUK MENAMPILKAN LAPORAN
# MIDDLEWARE = inherit

Route::prefix('laporan')->name('laporan.')->group(function () {
    # MAHASISWA
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('per-angkatan', [MahasiswaReportController::class, 'perAngkatan'])
            ->name('per-angkatan');
    });

    # IBU HAMIL
    Route::prefix('ibu-hamil')->name('ibu-hamil.')->group(function () {
        Route::get('profil', [IbuHamilReportController::class, 'profil'])
            ->name('profil');
    });

    # PENYAKIT
    Route::prefix('penyakit')->name('penyakit.')->group(function () {
        Route::get('jumlah-terbanyak', [PenyakitReportController::class, 'jumlahTerbanyak'])
            ->name('jumlah-terbanyak');
    });
});
