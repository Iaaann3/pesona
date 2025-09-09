<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserIklanController;
use App\Http\Controllers\UserKegiatanController;
use App\Http\Controllers\UserPembayaranController;
use App\Http\Controllers\UserPengumumanController;
use app\Http\Controllers\UserBayarController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ================= Admin Routes =================
Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => ['auth:admin' ],
], function () {
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('iklan', IklanController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('saran', KritikSaranController::class);
    Route::resource('rekenings', RekeningController::class);
});

Route::get('login/admin', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('login/admin', [AdminController::class, 'login'])->name('admin.login');


// ================= User Routes =================
Route::group([
    'prefix'     => 'user',
    'as'         => 'user.',
    'middleware' => ['auth'],
], function () {
    // Dashboard utama user
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');

    // Halaman home user
    Route::get('/home', [UserDashboardController::class, 'index'])
        ->name('home.index');

    Route::post('/bayar', [UserDashboardController::class, 'store'])
        ->name('bayar.store');


    // Daftar pembayaran
    Route::get('/pembayaran', [App\Http\Controllers\UserPembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // Riwayat pembayaran
    Route::get('/pembayaran/riwayat', [App\Http\Controllers\UserPembayaranController::class, 'riwayat'])
        ->name('pembayaran.riwayat');

    // bayar
   

        
    // Detail pembayaran
    Route::get('/pembayaran/{id}/detail', [UserPembayaranController::class, 'detail'])
        ->name('pembayaran.detail');

    // Bayar
    Route::post('/pembayaran/{id}/bayar', [App\Http\Controllers\UserPembayaranController::class, 'bayar'])
        ->name('pembayaran.bayar');

    // Kegiatan
    Route::get('/kegiatan', [UserKegiatanController::class, 'index'])
        ->name('kegiatan.index');

    Route::get('/kegiatan/{id}', [UserKegiatanController::class, 'show'])
        ->name('kegiatan.show');

// Pengumuman
    Route::get('/pengumuman', [UserPengumumanController::class, 'index'])
        ->name('pengumuman.index');

    Route::get('/pengumuman/{id}', [UserPengumumanController::class, 'show'])
        ->name('pengumuman.show');

// Profile
    Route::get('/my-profile', [UserProfileController::class, 'index'])
        ->name('profile.index');

    // Kritik & Saran
    Route::get('/kritik-saran', [App\Http\Controllers\UserSaranController::class, 'index'])
        ->name('saran.index');
    Route::post('/kritik-saran', [App\Http\Controllers\UserSaranController::class, 'store'])
        ->name('saran.store');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});
