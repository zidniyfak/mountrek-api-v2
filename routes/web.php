<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminHikingController;
use App\Http\Controllers\admin\AdminHikingRouteController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminMountainController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\ApiMountainController;
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
Route::get('/', [AdminLoginController::class, 'index'])->name('login');
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
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/mountains', [AdminMountainController::class, 'index'])->name('mountains.index');
    Route::get('/mountains/create', [AdminMountainController::class, 'create'])->name('mountains.create');
    Route::post('/mountains/store', [AdminMountainController::class, 'store'])->name('mountains.store');
    Route::get('/mountains/edit/{id}', [AdminMountainController::class, 'edit'])->name('mountains.edit');
    Route::put('/mountains/{id}', [AdminMountainController::class, 'update'])->name('mountains.update');
    Route::delete('/mountains/{id}', [AdminMountainController::class, 'destroy'])->name('mountains.destroy');

    Route::get('/hikingroutes', [AdminHikingRouteController::class, 'index'])->name('hikingroutes.index');
    Route::get('/hikingroutes/create', [AdminHikingRouteController::class, 'create'])->name('hikingroutes.create');
    Route::post('/hikingroutes/store', [AdminHikingRouteController::class, 'store'])->name('hikingroutes.store');
    Route::get('/hikingroutes/edit/{id}', [AdminHikingRouteController::class, 'edit'])->name('hikingroutes.edit');
    Route::put('/hikingroutes/{id}', [AdminHikingRouteController::class, 'update'])->name('hikingroutes.update');
    Route::delete('/hikingroutes/{id}', [AdminHikingRouteController::class, 'destroy'])->name('hikingroutes.destroy');

    Route::get('/hikings', [AdminHikingController::class, 'index'])->name('hikings.index');
    Route::get('/hikings/create', [AdminHikingController::class, 'create'])->name('hikings.create');
    Route::post('/hikings/store', [AdminHikingController::class, 'store'])->name('hikings.store');
    Route::get('/hikings/edit/{id}', [AdminHikingController::class, 'edit'])->name('hikings.edit');
    Route::put('/hikings/{id}', [AdminHikingController::class, 'update'])->name('hikings.update');
    Route::delete('/hikings/{id}', [AdminHikingController::class, 'destroy'])->name('hikings.destroy');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/api/mountains/{mountain}/hikingroutes', [ApiMountainController::class, 'getHikingRoutes']);
// Route::get('/mountains', [AdminMountainController::class, 'index'])->name('mountains');
