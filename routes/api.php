<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return User::all();
});

Route::get('/patients/s/{id?}', function (Request $request,$id = null) {
    $s = $request->input('document') ?? false;
    if (!$s) return ['valid' => false, 'text' => trans('validation.required', ['attribute' => trans('locale.fields.document')])];
    $patient = Patient::firstWhere('document', $s);
    
    if ($id && $patient) 
        return ($patient->id != $id) ?  ['valid' => false, 'text' => trans('locale.Ok, got it!')] : ['valid' => true, 'text' => trans('locale.Ok, got it!')];
     
    if (!$patient) return ['valid' => true, 'text' => trans('locale.No Results Found.')];
    return ['valid' => false, 'text' => trans('locale.Ok, got it!')];
});

Route::get('/users/s/{id?}', function (Request $request,$id = null) {
    $s = $request->input('document') ?? false;
    if (!$s) return ['valid' => false, 'text' => trans('validation.required', ['attribute' => trans('locale.fields.document')])];
    $patient = User::firstWhere('document', $s);
    
    if ($id && $patient) 
        return ($patient->id != $id) ?  ['valid' => false, 'text' => trans('locale.Ok, got it!')] : ['valid' => true, 'text' => trans('locale.Ok, got it!')];
     
    if (!$patient) return ['valid' => true, 'text' => trans('locale.No Results Found.')];
    return ['valid' => false, 'text' => trans('locale.Ok, got it!')];
});
