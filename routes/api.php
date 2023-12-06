<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\FootballerController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\NationalController;
use App\Http\Controllers\OfferController;
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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', AdminController::class);
    Route::apiResource('clubs', ClubController::class);
    Route::apiResource('nationals',NationalController::class);
    Route::apiResource('footballers',FootballerController::class);
    Route::apiResource('markets',MarketController::class);
    Route::get('/offers', [OfferController::class, 'index']);
    Route::get('/offers/{offer}', [OfferController::class, 'show']);
    Route::post('/offers/{market}', [OfferController::class, 'store']);
    Route::post('/offers/accept/{offer}', [OfferController::class, 'accept']);
    Route::put('/offers/{offer}', [OfferController::class, 'update']);
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy']);
    Route::post('/offers/decline/{offer}', [OfferController::class, 'decline']);




});

Route::post('/login', [AuthController::class, 'login']);
