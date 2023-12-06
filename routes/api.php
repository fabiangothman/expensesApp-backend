<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyBoxController;

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

// Money Boxes Routes
Route::get('/money-boxes', [MoneyBoxController::class, 'index']);
Route::get('/money-boxes/{id}', [MoneyBoxController::class, 'show']);
Route::post('/money-boxes', [MoneyBoxController::class, 'store']);
Route::put('/money-boxes/{id}', [MoneyBoxController::class, 'update']);
Route::delete('/money-boxes/{id}', [MoneyBoxController::class, 'destroy']);
