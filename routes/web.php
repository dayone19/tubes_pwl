<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\absensiController; // Sesuaikan dengan nama file controller kamu
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

    // 4. KELOLA KARYAWAN
    Route::get('/kelola-karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/kelola-karyawan/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');

    // 5. ABSENSI
    Route::get('/absensi', [absensiController::class, 'index'])->name('absensi.index');

    // 6. PAYROLL
    // Halaman index payroll umum
    Route::get('/hitung-payroll', [PayrollController::class, 'dataPayroll'])->name('payroll.index');
    
    // ROUTE BARU: Khusus Akuntan untuk kelola gaji
    Route::get('/payroll/manage', [PayrollController::class, 'manage'])->name('payroll.manage');

    // 7. USER MANAGEMENT (CRUD)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});