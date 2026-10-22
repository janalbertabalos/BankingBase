
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/transactions', [TransactionController::class, 'index'])
    ->name('transactions.index');

Route::get('/transactions/create', [TransactionController::class, 'create'])
    ->name('transactions.create');

Route::post('/transactions', [TransactionController::class, 'store'])
    ->name('transactions.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
