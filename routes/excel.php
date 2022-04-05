<?php

use App\Http\Controllers\Excel\FakultasExcelController;
use App\Http\Controllers\Excel\ProdiExcelController;
use App\Http\Controllers\Excel\PenyakitExcelController;
use App\Http\Controllers\Excel\PuskesmasExcelController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN EXPORT DAN IMPORT FILE EXCEL
# MIDDLEWARE = inherit

Route::prefix('excel')->name('excel.')->group(function () {
    # IMPORT
    Route::prefix('import')->name('import.')->group(function () {
        Route::post('fakultas', [FakultasExcelController::class, 'import'])->name('fakultas');
        Route::post('prodi', [ProdiExcelController::class, 'import'])->name('prodi');
        Route::post('penyakit', [PenyakitExcelController::class, 'import'])->name('penyakit');
        Route::post('puskesmas', [PuskesmasExcelController::class, 'import'])->name('puskesmas');
    });

    # EXPORT
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('fakultas', [FakultasExcelController::class, 'export'])->name('fakultas');
        Route::get('prodi', [ProdiExcelController::class, 'export'])->name('prodi');
        Route::get('penyakit', [PenyakitExcelController::class, 'export'])->name('penyakit');
        Route::get('puskesmas', [PuskesmasExcelController::class, 'export'])->name('puskesmas');
    });
});
