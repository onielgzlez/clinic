<?php

//use App\Http\Controllers\AreaJobController;
use Illuminate\Support\Facades\Route;

//Route::prefix('areas')->name('areas.')->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria'])->group(function () {
//    Route::resource('', AreaJobController::class)->middleware('auth'); 
//});

Route::resource('areas', AreaJobController::class)->middleware(['auth', 'role:Administrador,Administrador clínica,Secretaria']);

