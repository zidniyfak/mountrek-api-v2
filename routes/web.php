<?php

use App\Http\Controllers\admin\AdminDashboardController;
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
Route::get('/', [AdminDashboardController::class, 'index']);

// Route::get('/mountains', [AdminMountainController::class, 'index'])->name('mountains');
// Route::get('/mountains/create', [AdminMountainController::class, 'create'])->name('mountains.create');
// Route::post('/mountains/store', [AdminMountainController::class, 'store'])->name('mountains.store');
// Route::get('/mountains/edit/{id}', [AdminMountainController::class, 'edit'])->name('mountains.edit');
// Route::put('/mountains/update/{id}', [AdminMountainController::class, 'update'])->name('mountains.update');
// Route::delete('/mountains/destroy/{id}', [AdminMountainController::class, 'destroy'])->name('mountains.destroy');
Route::prefix('mountains')->group(function () {
    Route::get('/', [AdminMountainController::class, 'index'])->name('mountains.index');
    Route::get('/create', [AdminMountainController::class, 'create'])->name('mountains.create');
    Route::post('/store', [AdminMountainController::class, 'store'])->name('mountains.store');
    Route::get('/edit/{id}', [AdminMountainController::class, 'edit'])->name('mountains.edit');
    Route::put('/{id}', [AdminMountainController::class, 'update'])->name('mountains.update');
    Route::delete('/{id}', [AdminMountainController::class, 'destroy'])->name('mountains.destroy');
});

// Route::resource('/mountains', \App\Http\Controllers\admin\AdminMountainController::class);
