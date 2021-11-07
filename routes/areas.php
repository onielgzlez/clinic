<?php

use App\Http\Controllers\AreaJobController;
use Illuminate\Support\Facades\Route;

Route::prefix('areas')->name('areas.')->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria'])->group(function () {
    Route::get('/', [AreaJobController::class, 'index'])
        ->name('list');
    Route::get('/{id}/show', [AreaJobController::class, 'show'])
        ->name('show');
    Route::get('/create', [AreaJobController::class, 'create'])
        ->name('create');
    Route::post('/store', [AreaJobController::class, 'store'])
        ->name('store');
    Route::get('/{id}/edit', [AreaJobController::class, 'edit'])
        ->name('edit');
    Route::post('/{id}/put', [AreaJobController::class, 'update'])
        ->name('update');
    Route::post('/{id}/destroy', [AreaJobController::class, 'destroy'])
        ->name('delete');
});
