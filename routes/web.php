<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
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

Route::middleware(['auth'])->group(function () {
    Route::resource('profil', ProfilController::class)->only('index', 'update');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    # IMPORT ROUTE
    require 'admin.php';
    require 'user.php';
    require 'report.php';
    require 'excel.php';
    require 'pdf.php';
});
