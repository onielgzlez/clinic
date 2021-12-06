<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('appointments')->name('appointments.')->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria'])->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])
        ->name('list');
    Route::get('/{id}/show', [AppointmentController::class, 'show'])
        ->name('show');
    Route::get('/create', [AppointmentController::class, 'create'])
        ->name('create');
    Route::post('/store', [AppointmentController::class, 'store'])
        ->name('store');
    Route::get('/{id}/edit', [AppointmentController::class, 'edit'])
        ->name('edit');
    Route::post('/{id}/put', [AppointmentController::class, 'update'])
        ->name('update');
    Route::post('/{id}/destroy', [AppointmentController::class, 'destroy'])
        ->name('delete');
});
