<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\User\ListBeritaController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('profil', ProfilController::class)->only('index', 'update');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::middleware('roles:superadmin,admin')->group(function () {
        // Berita
        Route::resource('berita', BeritaController::class)
            ->parameters(['berita' => 'berita']);
        Route::post('berita/{berita}/status', [BeritaController::class, 'status'])
            ->name('berita.status');

        Route::prefix('master')->name('master.')->group(function () {
            // Pengguna
            Route::resource('pengguna', PenggunaController::class);
            Route::post('pengguna/{pengguna}/status', [PenggunaController::class, 'status'])
                ->name('pengguna.status');

            // Penyakit
            Route::resource('penyakit', PenyakitController::class);

            // Puskesmas
            Route::resource('puskesmas', PuskesmasController::class)
                ->parameters(['puskesmas' => 'puskesmas']);
        });
    });

    Route::prefix('user')->name('user.')->middleware('roles:user,mahasiswa')->group(function () {
        // Berita
        Route::resource('berita', ListBeritaController::class)
            ->parameters(['berita' => 'slug'])
            ->only('index', 'show');
    });
});
