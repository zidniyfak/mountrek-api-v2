<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminMountainController;
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

// Menambahkan route untuk halaman utama


// Route Halaman Authentication
Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
Route::post('/login-process', [AdminLoginController::class, 'login_process'])->name('login-process');
Route::get('/register', [AdminLoginController::class, 'register'])->name('register');
Route::post('/register-proses', [AdminLoginController::class, 'register_process'])->name('register-proses');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AdminLoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-process', [AdminLoginController::class, 'forgot_password_process'])->name('forgot-password-process');

Route::get('/validasi-forgot-password/{token}', [AdminLoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-process', [AdminLoginController::class, 'validasi_forgot_password_process'])->name('validasi-forgot-password_process');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'as' => 'admin.'], function () {
    // Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard')->middleware(['can:view_dashboard']);
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/mountains', [AdminMountainController::class, 'index'])->name('mountains.index');
    Route::get('/mountains/create', [AdminMountainController::class, 'create'])->name('mountains.create');
    Route::post('/mountains/store', [AdminMountainController::class, 'store'])->name('mountains.store');
    Route::get('/mountains/edit/{id}', [AdminMountainController::class, 'edit'])->name('mountains.edit');
    Route::put('/mountains/{id}', [AdminMountainController::class, 'update'])->name('mountains.update');
    Route::delete('/mountains/{id}', [AdminMountainController::class, 'destroy'])->name('mountains.destroy');
});

// Route::get('/mountains', [AdminMountainController::class, 'index'])->name('mountains');
