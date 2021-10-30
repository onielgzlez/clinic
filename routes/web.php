<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('change_locale');

Route::get('/organizations', [OrganizationController::class, 'index'])
    ->middleware('auth')
    ->name('organizations');

Route::post('/organizations', [OrganizationController::class, 'store'])
    ->middleware('auth');

Route::get('js/translations.js', function () {
    $lang = session()->get('locale') ?? config('app.locale');    
    $strings = \Illuminate\Support\Facades\Cache::rememberForever('lang_' . $lang . '.js', function () use ($lang) {
        $path = resource_path('lang' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR);
        $files = scandir($path);
        unset($files[array_search('.', $files, true)]);
        unset($files[array_search('..', $files, true)]);
        unset($files[array_search('.json', $files, true)]);
        $strings = [];

        foreach ($files as $file) {
            $name = basename($file, '.php');
            $strings[$name] = require $path . $file;
        }
        return $strings;
    });
    header('Content-Type: text/javascript');
    echo ('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('translations');

require __DIR__ . '/auth.php';
require __DIR__ . '/users.php';
