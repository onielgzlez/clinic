<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::prefix('especialistas')->name('especialistas.')->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria,Contadora'])->group(function () {
Route::resource('', WorkerController::class)->middleware('auth'); 
});
