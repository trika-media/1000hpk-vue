<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PuskesmasController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN UNTUK ROLE ADMIN/SUPERADMIN
# MIDDLEWARE = roles:superadmin,admin

Route::middleware('roles:superadmin,admin')->group(function () {
    # BERITA
    Route::resource('berita', BeritaController::class)
        ->parameters(['berita' => 'berita']);
    Route::post('berita/{berita}/status', [BeritaController::class, 'status'])
        ->name('berita.status');

    # MAHASISWA
    Route::resource('mahasiswa', MahasiswaController::class);

    # IBU HAMIL
    Route::resource('ibu-hamil', IbuHamilController::class);

    Route::prefix('master')->name('master.')->group(function () {
        # PENGGUNA
        Route::resource('pengguna', PenggunaController::class);
        Route::post('pengguna/{pengguna}/status', [PenggunaController::class, 'status'])
            ->name('pengguna.status');

        # PENYAKIT
        Route::resource('penyakit', PenyakitController::class);

        # PUSKESMAS
        Route::resource('puskesmas', PuskesmasController::class)
            ->parameters(['puskesmas' => 'puskesmas']);
    });
});
