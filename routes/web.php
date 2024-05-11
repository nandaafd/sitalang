<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MasterPelanggaranController as WebMasterPelanggaranController;
use App\Http\Controllers\web\PelanggaranSiswaController as WebPelanggaranSiswaController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\web\SanksiController as WebSanksiController;
use App\Http\Controllers\Web\SiswaController as WebSiswaController;
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


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-store', [RegisterController::class, 'store'])->name('register-store');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/send-otp/{email}', [OtpController::class,'createOtp'])->name('sendOtp');
Route::post('/verif-otp/{otp}/{email}', [OtpController::class,'verifyOtp'])->name('verifOtp');
Route::put('/block',[UserController::class,'block'])->name('block');

//forgot password
Route::get('/forgot-password',[ForgotPasswordController::class, 'index']);
Route::post('/sendmail',[ForgotPasswordController::class, 'sendMail'])->name('sendMail');
Route::get('/reset-password/{id}',[ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::put('/reset-password-process/{id}',[ForgotPasswordController::class, 'process'])->name("ForgotPassword");

Route::group(['middleware' => ['admin']], function(){
    Route::prefix('dashboard')->group(function () {
        Route::resource('/', DashboardController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('sanksi', SanksiController::class);
        Route::resource('masterpelanggaran', MasterPelanggaranController::class);
        Route::resource('pelanggaransiswa', PelanggaranSiswaController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::get('change-password/{id}',[ChangePasswordController::class,'IndexFromDashboard']);
        Route::put('change-password/{id}/update',[ChangePasswordController::class, 'Update'])->name('update-password');
    });
});
Route::get('/', function () {
    return redirect('/home');
});
Route::resource('/home',HomeController::class);

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['guru']], function(){
        Route::resource('/data-sanksi', WebSanksiController::class);
        Route::resource('/pelanggaran', WebMasterPelanggaranController::class);
        Route::resource('/data-siswa', WebSiswaController::class);
    });
    Route::resource('/profile',ProfileController::class);
    Route::resource('/pelanggaran-siswa', WebPelanggaranSiswaController::class);
    Route::get('changepassword/{id}',[ChangePasswordController::class,'IndexFromWeb']);
    Route::put('changepassword/{id}/update',[ChangePasswordController::class, 'Update'])->name('change-password');
});