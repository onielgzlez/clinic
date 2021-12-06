<?php

use App\Mail\AppointmentCloserTime;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentUserCloserTime;
use App\Mail\AppointmentUserCreated;
use App\Models\Appointment;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Thomasjohnkane\Snooze\ScheduledNotification;
use App\Notifications\Patient as PatientNotification;

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

Route::get('timezones', function (Request $request) {
    return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
});

Route::get('sent/{id}', function (Request $request, $id) {
    $appointment = Appointment::findOrFail($id);
    if ($appointment) {
        Mail::to($appointment->patient->email)->send(new AppointmentCloserTime($appointment));
        if ((isset($appointment->user->options['mail']) && $appointment->user->options['mail']))
            Mail::to($appointment->user->email)->send(new AppointmentUserCloserTime($appointment));
        return ['valid' => true, 'text' => trans('locale.Ok, got it!')];
    }
    return ['valid' => false, 'text' => trans('locale.No Results Found.')];
})->name('sent_email');

Route::get('/patients/s/{id?}', function (Request $request, $id = null) {
    $s = $request->input('document') ?? false;
    $r = $request->input('r') ?? false;
    if (!$s) return ['valid' => false, 'text' => trans('validation.required', ['attribute' => trans('locale.fields.document')])];
    $patient = Patient::firstWhere('document', $s);

    if ($id && $patient)
        return ($patient->id != $id) ?  ['valid' => false, 'text' => trans('locale.Ok, got it!')] : ['valid' => true, 'text' => trans('locale.Ok, got it!')];

    if (!$patient) return ['valid' => true, 'text' => trans('locale.No Results Found.')];
    if ($r) return ['valid' => true, 'patient' => $patient];
    return ['valid' => false, 'text' => trans('locale.Ok, got it!')];
});

Route::get('/organizations/{id}/patients', function ($id) {
    $org = Organization::findOrFail($id);
    $patients = [];
    $patientss = $org->patients->pluck('shortName', 'id');
    foreach ($patientss as $k => $v) {
        array_push($patients, ['id' => $k, 'name' => $v]);
    }
    return compact('patients');
});

Route::get('/organizations/{id}/workers', function (Request $request, $id) {
    $org = Organization::findOrFail($id);
    $s = $request->input('s') ?? false;
    $workers = [];
    if ($org->user && $org->user->type == 'worker') {
        if ($s && (int)$s == $org->user->area_job_id)
            array_push($workers, ['id' => $org->user_id, 'name' => $org->user->shortName, 'specialty' => $org->user->specialty, 'classificator' => $org->user->classification]);
        if (!$s)
            array_push($workers, ['id' => $org->user_id, 'name' => $org->user->shortName, 'specialty' => $org->user->specialty, 'classificator' => $org->user->classification]);
    }

    foreach ($org->workers as $worker) {
        if ($s && (int)$s == $worker->area_job_id)
            array_push($workers, ['id' => $worker->id, 'name' => $worker->shortName, 'specialty' => $worker->specialty, 'classificator' => $worker->classification]);
        if (!$s)
            array_push($workers, ['id' => $worker->id, 'name' => $worker->shortName, 'specialty' => $worker->specialty, 'classificator' => $worker->classification]);
    }
    return compact('workers');
});

Route::get('/users/s/{id?}', function (Request $request, $id = null) {
    $s = $request->input('document') ?? false;
    if (!$s) return ['valid' => false, 'text' => trans('validation.required', ['attribute' => trans('locale.fields.document')])];
    $patient = User::firstWhere('document', $s);

    if ($id && $patient)
        return ($patient->id != $id) ?  ['valid' => false, 'text' => trans('locale.Ok, got it!')] : ['valid' => true, 'text' => trans('locale.Ok, got it!')];

    if (!$patient) return ['valid' => true, 'text' => trans('locale.No Results Found.')];
    return ['valid' => false, 'text' => trans('locale.Ok, got it!')];
});
