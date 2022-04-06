<?php

use App\Http\Controllers\PDF\IbuHamilPdfController;
use App\Http\Controllers\PDF\MahasiswaPdfController;
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
    });
});
