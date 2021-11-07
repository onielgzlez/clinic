<?php

use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('finances')->name('finances.')->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria,Contadora'])->group(function () {
    Route::get('/', [FinanceController::class, 'index'])
        ->name('list');
    Route::get('/{id}/show', [FinanceController::class, 'show'])
        ->name('show');
    Route::get('/create', [FinanceController::class, 'create'])
        ->name('create');
    Route::post('/store', [FinanceController::class, 'store'])
        ->name('store');
    Route::get('/{id}/edit', [FinanceController::class, 'edit'])
        ->name('edit');
    Route::post('/{id}/put', [FinanceController::class, 'update'])
        ->name('update');
    Route::post('/{id}/destroy', [FinanceController::class, 'destroy'])
        ->name('delete');
});
