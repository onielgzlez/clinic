<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user-profile')->name('user.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'profile'])
        ->name('profile');
    Route::get('/profile-overview', [UserController::class, 'overview'])
        ->name('profile.overview');
    Route::get('/personal-information', [UserController::class, 'personal'])
        ->name('profile.info');
    Route::get('/account-information', [UserController::class, 'account'])
        ->name('profile.account');
    Route::get('/change-password', [UserController::class, 'password'])
        ->name('profile.password');
    Route::get('/plan/upgrade', [UserController::class, 'personal'])
        ->name('profile.upgrade');
});


Route::prefix('users')->name('users.')->middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('list');
    Route::get('/{id}/show', [UserController::class, 'show'])
        ->name('show');
    Route::get('/create', [UserController::class, 'create'])
        ->name('create');
    Route::post('/store', [UserController::class, 'store'])
        ->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])
        ->name('edit');
    Route::post('/{id}/put', [UserController::class, 'update'])
        ->name('update');
    Route::post('/{id}/destroy', [UserController::class, 'destroy'])
        ->name('delete');
});
