<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GuruController;
use App\Http\Controllers\Dashboard\KelasController;
use App\Http\Controllers\Dashboard\MasterPelanggaranController;
use App\Http\Controllers\Dashboard\PelanggaranSiswaController;
use App\Http\Controllers\Dashboard\SanksiController;
use App\Http\Controllers\Dashboard\SiswaController;
use App\Http\Controllers\Dashboard\UserController;
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
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-store', [RegisterController::class, 'store'])->name('register-store');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/send-otp/{email}', [OtpController::class,'createOtp'])->name('sendOtp');
Route::post('/verif-otp/{otp}/{email}', [OtpController::class,'verifyOtp'])->name('verifOtp');
Route::put('/block',[UserController::class,'block'])->name('block');

Route::prefix('dashboard')->group(function () {
    Route::resource('/', DashboardController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('sanksi', SanksiController::class);
    Route::resource('masterpelanggaran', MasterPelanggaranController::class);
    Route::resource('pelanggaransiswa', PelanggaranSiswaController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);

});
