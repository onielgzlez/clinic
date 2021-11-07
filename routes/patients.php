<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::prefix('patients')->name('patients.')->middleware(['auth'])->group(function () {
    Route::get('/', [PatientController::class, 'index'])->middleware('role:Administrador,Administrador clínica,Secretaria,Especialista')
        ->name('list');
    Route::get('/{id}/show', [PatientController::class, 'show'])->middleware('role:Administrador,Administrador clínica,Secretaria,Especialista')
        ->name('show');
    Route::get('/create', [PatientController::class, 'create'])->middleware('role:Administrador,Administrador clínica,Secretaria')
        ->name('create');
    Route::post('/store', [PatientController::class, 'store'])->middleware('role:Administrador,Administrador clínica,Secretaria')
        ->name('store');
    Route::get('/{id}/edit', [PatientController::class, 'edit'])->middleware('role:Administrador,Administrador clínica,Secretaria')
        ->name('edit');
    Route::post('/{id}/put', [PatientController::class, 'update'])->middleware('role:Administrador,Administrador clínica,Secretaria')
        ->name('update');
    Route::post('/{id}/destroy', [PatientController::class, 'destroy'])->middleware('role:Administrador,Administrador clínica,Secretaria')
        ->name('delete');
});
