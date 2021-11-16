<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\WorkerController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('change_locale');

    Route::resource('/users', UserController::class)->middleware('auth');


Route::get('clearLocale', function () {
        $lang = session()->get('locale') ?? request()->user()->locale ?? config('app.locale');    
        \Illuminate\Support\Facades\Cache::forget('lang_' . $lang . '.js');
        exit();
    })->name('clearLocale');

Route::get('js/translations.js', function () {
    $lang = session()->get('locale') ?? request()->user()->locale ?? config('app.locale');    
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

Route::fallback([DashboardController::class, 'index'])->middleware('auth');

require __DIR__ . '/auth.php';
require __DIR__ . '/areas.php';
require __DIR__ . '/patients.php';
require __DIR__ . '/finances.php';
require __DIR__ . '/users.php';
require __DIR__ . '/organizations.php';
require __DIR__ . '/workers.php';
require __DIR__ . '/areas.php';
