<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentUpdated;
use App\Mail\AppointmentUserCreated;
use App\Mail\AppointmentUserUpdated;
use App\Models\Appointment;
use App\Models\AreaJob;
use App\Models\Organization;
use App\Models\Patient;
use App\Notifications\AppointmentNotification;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Thomasjohnkane\Snooze\ScheduledNotification;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = request()->user();
        $totalU = Appointment::count();
        if (!$user->isAdmin())
            $totalU = Appointment::where('organization_id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', '=', $user->id)->orWhereRelation('organization', 'user_id', '=', $user->id)->count();

        if ($request->isXmlHttpRequest()) {
            $pagination = $request->input('pagination');
            extract($pagination);
            $sort = $request->input('sort');
            $query = $request->input('query');
            $field = $sort['field'];
            $sDir = $sort['sort'];

            // search filter by keywords
            $filter = $query['generalSearch'] ?? '';

            $offset = 0;

            if ($perpage > 0) {
                $pages = ceil($totalU / $perpage); // calculate total pages
                $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
                $page = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
                $offset = ($page - 1) * $perpage;
                if ($offset < 0) {
                    $offset = 0;
                }
            }

            $data = Appointment::orderBy($field, $sDir)->offset($offset)->limit($perpage);
            if ($filter) $data = $data->where('type', 'like', "$filter%")->orWhere('user_id', 'like', "$filter%");

            if (!$user->isAdmin())
                $data = $data->where('organization_id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', '=', $user->id)->orWhereRelation('organization', 'user_id', '=', $user->id);

            $data = $data->get();

            if ($filter) {
                $totalU = count($data);
                $pages = ceil($totalU / $perpage); // calculate total pages
                $page = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
                $page = min($page, $pages);
            }

            $meta = array(
                'page' => $page,
                'pages' => $pages,
                'perpage' => $perpage,
                'total' => $totalU,
                "sort" => "$sDir",
                "field" => "$field",
                "query" => $query,
            );

            return response()->json(['meta' => $meta, 'data' => AppointmentResource::collection($data)]);
        }

        return view('appointments.index', ['total' => $totalU]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = request()->user();
        $organizations = Organization::orderBy('id', 'desc');
        if (!$user->isAdmin()) {
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', $user->id);
        }
        $organizations = $organizations->get();
        $areas = AreaJob::all();
        $statuss = array_filter($this->statuses(), function ($st) {
            return $st['id'] === 1 || $st['id'] === 2;
        });
        return view('appointments.create', compact('user', 'organizations', 'areas', 'statuss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'organization_id' => 'required',
            'user_id' => 'required',
            'observation' => 'required',
        ]);

        $input = $request->all();
        $dataAppointment = Arr::except($input, 'patient');
        $dataPatient = Arr::only($input, 'patient');

        $patient = Patient::firstOrNew(
            ['document' => $dataPatient['patient']['document']],
            $dataPatient['patient']
        );
        $dataAppointment['patient_id'] = $patient->id;
        $appointment = Appointment::create($dataAppointment);
        $this->notifyEmail($appointment, true);
        $this->notifyWhen($appointment, true);
        return redirect()->route('appointments.list')
            ->with('success', trans('locale.The item was created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Appointment::findOrFail($id);
        return view('appointments.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = request()->user();
        $organizations = Organization::orderBy('id', 'desc');
        if (!$user->isAdmin()) {
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', $user->id);
        }
        $organizations = $organizations->get();
        $areas = AreaJob::all();
        $statuss = $this->statuses();
        return view('appointments.edit', compact('user', 'appointment', 'organizations', 'areas', 'statuss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->validate($request, [
            'status' => 'required',
            'organization_id' => 'required',
            'user_id' => 'required',
            'patient_id' => 'required',
            'observation' => 'required',
        ]);

        $input = $request->all();

        $appointment->update($input);
        $this->notifyEmail($appointment);
        $this->notifyWhen($appointment);
        return redirect()->route('appointments.list')
            ->with('success', trans('locale.The item was updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Appointment::findOrFail($id);
        $user->delete();
        return redirect()->route('appointments.list')
            ->with('success', trans('locale.The item was deleted successfully'));
    }

    private function statuses()
    {
        return [
            ['id' => 1, 'name' => 'Reservada'],
            ['id' => 2, 'name' => 'Aprobada'],
            ['id' => 3, 'name' => 'Cancelada'],
            ['id' => 4, 'name' => 'Realizada'],
            ['id' => 5, 'name' => 'Archivada'],
        ];
    }

    /**
     * Notify schedule for a date when certains conditions are satisfy
     * via whatsapp and sms
     */
    private function notifyWhen($appointment, $s = false)
    {
        //for patient
        $target = (new AnonymousNotifiable)
            ->route('sms', $appointment->patient->phone)
            ->route('whatsapp', $appointment->patient->whatsapp ?? $appointment->patient->phone);
        $user = request()->user();
        $now = Carbon::now($user->timezone);
        ScheduledNotification::create(
            $target, // Target
            new AppointmentNotification($appointment), // Notification
            $now // Send At
        );

        $isNotifyUserActive = (isset($user->options['sms']) && $user->options['sms']) || (isset($user->options['whatsapp']) && $user->options['whatsapp']);

        //for user
        if ($isNotifyUserActive) {
            $targetUser = (new AnonymousNotifiable)
                ->route('sms', $user->phone)
                ->route('whatsapp', $user->phone);

            ScheduledNotification::create(
                $targetUser, // Target
                new UserNotification($appointment), // Notification for user
                $now // Send At
            );
        }

        if ($s) {
            $targetDate = Carbon::parse($appointment->init, $user->timezone)->subMinutes(config('app.elapsedTimer'));
            //30 minutes before
            if ($targetDate > $now) {
                ScheduledNotification::create(
                    $target, // Target
                    new AppointmentNotification($appointment), // Notification for patient
                    $targetDate // Send At
                );
            }
            //for user
            if ($isNotifyUserActive && $targetDate > $now) {
                ScheduledNotification::create(
                    $targetUser, // Target
                    new UserNotification($appointment), // Notification for user
                    $targetDate // Send At
                );
            }
        }
    }

    private function notifyEmail($appointment, $new = false)
    {
        $user = request()->user();
        Mail::to($appointment->patient->email)->send($new ? new AppointmentCreated($appointment) : new AppointmentUpdated($appointment));
        $isNotifyUserActive = (isset($user->options['email']) && $user->options['email']);

        //for user
        if ($isNotifyUserActive)
            Mail::to($user->email)->send($new ? new AppointmentUserCreated($appointment) : new AppointmentUserUpdated($appointment));
    }
}
