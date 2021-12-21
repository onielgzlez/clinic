<?php

//use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

//Route::prefix('organizations')->name('organizations.')->middleware(['auth', 'role:Administrador,Administrador clínica'])->group(function () {
//    Route::resource('', OrganizationController::class)->middleware('auth'); 
//    });
Route::resource('organizations', OrganizationController::class)->middleware(['auth', 'role:Administrador,Administrador clínica']);
