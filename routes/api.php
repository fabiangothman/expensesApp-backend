<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseGroupController;
use App\Http\Controllers\ExpenseGroupUserController;
use App\Http\Controllers\MoneyBoxController;
use App\Http\Controllers\ScheduledExpenseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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


// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User Routes
Route::get('/user', [UserController::class, 'index'])->middleware('auth:sanctum');


// MoneyBox Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/money-boxes', [MoneyBoxController::class, 'index']);
    Route::get('/money-boxes/{id}', [MoneyBoxController::class, 'show']);
    Route::post('/money-boxes', [MoneyBoxController::class, 'store']);
    Route::put('/money-boxes/{id}', [MoneyBoxController::class, 'update']);
    Route::delete('/money-boxes/{id}', [MoneyBoxController::class, 'destroy']);
});

// ExpenseGroup Routes
Route::get('/expense-group', [ExpenseGroupController::class, 'index']);
Route::get('/expense-group/{id}', [ExpenseGroupController::class, 'show']);
Route::post('/expense-group', [ExpenseGroupController::class, 'store']);
Route::put('/expense-group/{id}', [ExpenseGroupController::class, 'update']);
Route::delete('/expense-group/{id}', [ExpenseGroupController::class, 'destroy']);

// ExpenseGroupUser Routes
Route::get('/expense-group-user', [ExpenseGroupUserController::class, 'index']);
Route::get('/expense-group-user/{id}', [ExpenseGroupUserController::class, 'show']);
Route::post('/expense-group-user', [ExpenseGroupUserController::class, 'store']);
Route::put('/expense-group-user/{id}', [ExpenseGroupUserController::class, 'update']);
Route::delete('/expense-group-user/{id}', [ExpenseGroupUserController::class, 'destroy']);

// ExpenseCategory Routes
Route::get('/expense-category', [ExpenseCategoryController::class, 'index']);
Route::get('/expense-category/{id}', [ExpenseCategoryController::class, 'show']);
Route::post('/expense-category', [ExpenseCategoryController::class, 'store']);
Route::put('/expense-category/{id}', [ExpenseCategoryController::class, 'update']);
Route::delete('/expense-category/{id}', [ExpenseCategoryController::class, 'destroy']);

// Expense Routes
Route::get('/expense', [ExpenseController::class, 'index']);
Route::get('/expense/{id}', [ExpenseController::class, 'show']);
Route::post('/expense', [ExpenseController::class, 'store']);
Route::put('/expense/{id}', [ExpenseController::class, 'update']);
Route::delete('/expense/{id}', [ExpenseController::class, 'destroy']);

// ScheduledExpense Routes
Route::get('/scheduled-expense', [ScheduledExpenseController::class, 'index']);
Route::get('/scheduled-expense/{id}', [ScheduledExpenseController::class, 'show']);
Route::post('/scheduled-expense', [ScheduledExpenseController::class, 'store']);
Route::put('/scheduled-expense/{id}', [ScheduledExpenseController::class, 'update']);
Route::delete('/scheduled-expense/{id}', [ScheduledExpenseController::class, 'destroy']);

// Transaction Routes
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
Route::post('/transaction', [TransactionController::class, 'store']);
Route::put('/transaction/{id}', [TransactionController::class, 'update']);
Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);

