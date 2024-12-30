<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HikingController;
use App\Http\Controllers\api\HikingRouteController;
use App\Http\Controllers\api\MountainController;
use App\Http\Controllers\api\WishlistController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/validate-otp', [AuthController::class, 'validateOtp']);
Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/user', [AuthController::class, 'user'])->middleware(['auth:sanctum']);
Route::put('/user', [AuthController::class, 'update'])->middleware(['auth:sanctum']);

Route::prefix('mountains')->group(function () {
    Route::get('/', [MountainController::class, 'index']);
    Route::get('/{id}', [MountainController::class, 'show']);
});
Route::get('/mountains-search', [MountainController::class, 'search']);

Route::apiResource('hikingroutes', HikingRouteController::class)->except(['store', 'update', 'destroy']);

Route::apiResource('hikings', HikingController::class)->middleware(['auth:sanctum']);
Route::put('update-hiking-status/{id}', [HikingController::class, 'updateHikingStatus']);
Route::put('cancel-hiking-status/{id}', [HikingController::class, 'updateCancelled']);
Route::get('/hikings-journey', [HikingController::class, 'journey'])->middleware(['auth:sanctum']);

Route::apiResource('wishlists', WishlistController::class)->except(['show', 'update'])->middleware(['auth:sanctum']);
