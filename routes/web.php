<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\DashboardController;

// 1. PORTAL UTAMA
Route::get('/', function () {
    return view('landingPage'); 
});

// 2. AUTHENTICATION
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// ---------------------------------------------------------
// SEMUA ROUTE DI BAWAH INI HARUS LOGIN (MIDDLEWARE AUTH)
// ---------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // 3. HALAMAN DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 4. KARYAWAN (WORKSHOP AREA)
    // Menghandle: index, create, store, show, edit, update, destroy
    // Form tambah teknisi kamu akan lari ke KaryawanController@store
    Route::resource('karyawan', KaryawanController::class);

    // 5. ABSENSI
    Route::get('/absensi', [absensiController::class, 'index'])->name('absensi.index');

    // 6. PAYROLL
    Route::get('/hitung-payroll', [PayrollController::class, 'dataPayroll'])->name('payroll.index');
    Route::get('/payroll/manage', [PayrollController::class, 'manage'])->name('payroll.manage');

    // 7. USER MANAGEMENT / AKSES KONTROL (SYSTEM AREA)
    // Gunakan UserController hanya untuk menampilkan daftar (index), update, dan hapus.
    // Pendaftaran akun baru sudah di-handle oleh KaryawanController@store
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
});