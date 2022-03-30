<?php

use App\Http\Controllers\API\IndonesiaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('indonesia')->name('indonesia.')->group(function () {
    Route::get('provinsi', [IndonesiaController::class, 'provinsi'])->name('provinsi');
    Route::get('kabupaten/{provinsi}', [IndonesiaController::class, 'kabupaten'])->name('kabupaten');
    Route::get('kecamatan/{kabupaten}', [IndonesiaController::class, 'kecamatan'])->name('kecamatan');
    Route::get('kelurahan/{kecamatan}', [IndonesiaController::class, 'kelurahan'])->name('kelurahan');
});
