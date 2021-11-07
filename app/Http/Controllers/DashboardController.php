<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\Finance;
use App\Models\Appointment;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = request()->user();
        $users = User::orderBy('created_at')
            ->take(5)
            ->get();
        $patients = Patient::orderBy('created_at');
        $organizations = Organization::orderBy('created_at');
        if (!$user->isAdmin()){
            $patients = $patients->whereRelation('organizations', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())
            ->orWhereRelation('organizations', 'user_id', '=', $user->id);
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())
            ->orWhere('user_id', '=', $user->id);
        }            
        $patients = $patients->take(5)->get();
        $organizations = $organizations->take(5)->get();

        return view('pages.dashboard', compact('users', 'patients', 'organizations'));
    }
}
