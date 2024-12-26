<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('mountains')->group(function () {
    Route::get('/', [MountainController::class, 'index']);
    Route::get('/{id}', [MountainController::class, 'show']);
    Route::get('/search', [MountainController::class, 'search']);
});
Route::apiResource('hikingroutes', HikingRouteController::class)->except(['store', 'update', 'destroy']);
Route::apiResource('hikings', HikingController::class);
Route::apiResource('wishlists', WishlistController::class)->except(['show', 'update']);
