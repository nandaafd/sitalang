<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\KelasController;
use App\Http\Controllers\Dashboard\MasterPelanggaranController;
use App\Http\Controllers\Dashboard\PelanggaranSiswaController;
use App\Http\Controllers\Dashboard\SanksiController;
use App\Models\Sanksi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::prefix('dashboard')->group(function () {
    Route::resource('/', DashboardController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('sanksi', SanksiController::class);
    Route::resource('masterpelanggaran', MasterPelanggaranController::class);
    Route::resource('pelanggaransiswa', PelanggaranSiswaController::class);



});
