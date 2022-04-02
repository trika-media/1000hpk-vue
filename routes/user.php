<?php

use App\Http\Controllers\User\DataDiriController;
use App\Http\Controllers\User\IbuHamilController;
use App\Http\Controllers\User\ListBeritaController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN UNTUK ROLE MAHASISWA DAN USER LAINNYA
# MIDDLEWARE = roles:user,mahasiswa || mahasiswa

Route::prefix('user')->name('user.')->middleware('roles:user,mahasiswa')->group(function () {
    # BERITA, Hanya list untuk mahasiswa
    Route::resource('berita', ListBeritaController::class)
        ->parameters(['berita' => 'slug'])
        ->only('index', 'show');

    Route::middleware('mahasiswa')->group(function () {
        # DATA DIRI MAHASISWA
        Route::resource('data-diri', DataDiriController::class)
            ->only('index', 'store');

        # IBU HAMIL
        Route::resource('ibu-hamil', IbuHamilController::class);
    });
});
