<?php

use App\Http\Controllers\Excel\FakultasExcelController;
use Illuminate\Support\Facades\Route;

# KUMPULAN ROUTE YANG DIGUNAKAN EXPORT DAN IMPORT FILE EXCEL
# MIDDLEWARE = inherit

Route::prefix('excel')->name('excel.')->group(function () {
    # IMPORT
    Route::prefix('import')->name('import.')->group(function () {
        # FAKULTAS
        Route::post('fakultas', [FakultasExcelController::class, 'import'])->name('fakultas');
    });

    # EXPORT
    Route::prefix('export')->name('export.')->group(function () {
        # FAKUTLAS
        Route::get('fakultas', [FakultasExcelController::class, 'export'])->name('fakultas');
    });
});
