<?php

use App\Http\Controllers\ExpenseGroupController;
use App\Http\Controllers\MoneyBoxController;
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


// MoneyBox Routes
Route::get('/money-boxes', [MoneyBoxController::class, 'index']);
Route::get('/money-boxes/{id}', [MoneyBoxController::class, 'show']);
Route::post('/money-boxes', [MoneyBoxController::class, 'store']);
Route::put('/money-boxes/{id}', [MoneyBoxController::class, 'update']);
Route::delete('/money-boxes/{id}', [MoneyBoxController::class, 'destroy']);

// ExpenseGroup Routes
Route::get('/expense-group', [ExpenseGroupController::class, 'index']);
Route::get('/expense-group/{id}', [ExpenseGroupController::class, 'show']);
Route::post('/expense-group', [ExpenseGroupController::class, 'store']);
Route::put('/expense-group/{id}', [ExpenseGroupController::class, 'update']);
Route::delete('/expense-group/{id}', [ExpenseGroupController::class, 'destroy']);
