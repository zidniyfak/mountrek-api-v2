<?php

use App\Http\Controllers\api\MountainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/mountains', [MountainController::class, 'index']);

Route::prefix('mountains')->group(function () {
    Route::get('/', [MountainController::class, 'index']);
    Route::get('/{id}', [MountainController::class, 'show']);
    Route::post('/', [MountainController::class, 'store']);
    Route::put('/{id}', [MountainController::class, 'update']);
    Route::delete('/{id}', [MountainController::class, 'destroy']);
});
