<?php

use App\Http\Controllers\PDF\IbuHamilPdfController;
use App\Http\Controllers\PDF\MahasiswaPdfController;
use App\Http\Controllers\PDF\PenyakitPdfController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN EXPORT PDF
# MIDDLEWARE = inherit

Route::prefix('pdf')->name('pdf.')->group(function () {
    # MAHASISWA
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('per-angkatan', [MahasiswaPdfController::class, 'perAngkatan'])
            ->name('per-angkatan');
    });

    # IBU HAMIL
    Route::prefix('ibu-hamil')->name('ibu-hamil.')->group(function () {
        Route::get('profil', [IbuHamilPdfController::class, 'profil'])
            ->name('profil');
        Route::get('detail/{id}', [IbuHamilPdfController::class, 'detail'])
            ->name('detail');
    });

    Route::prefix('penyakit')->name('penyakit.')->group(function () {
        Route::get('jumlah-terbanyak', [PenyakitPdfController::class, 'jumlahTerbanyak'])
            ->name('jumlah-terbanyak');
    });
});
