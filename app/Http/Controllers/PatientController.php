<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Resources\PatientResource;
use App\Models\City;
use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = request()->user();
        $totalU = Patient::count();
        if (!$user->isAdmin())
            $totalU = Patient::whereRelation('organizations', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organizations', 'user_id', '=', $user->id)->count();

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

            $data = Patient::orderBy($field, $sDir)->offset($offset)->limit($perpage);
            if ($filter) $data = $data->where('first_name', 'like', "$filter%")->orWhere('last_name', 'like', "$filter%")
                ->orWhere('email', 'like', "$filter%")->orWhere('document', 'like', "$filter%")->orWhere('city_id', 'like', "$filter%");

            if (!$user->isAdmin())
                $data = $data->whereRelation('organizations', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organizations','user_id','=',$user->id);

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

            return response()->json(['meta' => $meta, 'data' => PatientResource::collection($data)]);
        }

        return view('patients.index', ['total' => $totalU]);
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
        if (!$user->isAdmin())
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id',$user->id);
        $organizations = $organizations->get();
        $cities = City::all();
        return view('patients.create', compact('user', 'organizations', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'last_name2' => 'required',
            'email' => 'required|email|unique:patients,email',
            'document' => 'required|unique:patients,email',
            'address' => 'required',
            'city_id' => 'required',
        ]);

        $input = $request->all();

        $user = Patient::create($input);
        if ($request->file('photo')) {
            $path = $request->file('photo')->store(
                'imgs/patients/' . $user->id,
                'uploads'
            );
            $user->update(['photo' => $path]);
        }

        $user->organizations()->sync($request->input('organizations'),false);

        return redirect()->route('patients.list')
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
        $user = Patient::findOrFail($id);
        return view('patients.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Patient::findOrFail($id);
        $auth = request()->user();
        $organizations = Organization::orderBy('id', 'desc');
        if (!$auth->isAdmin())
            $organizations = $organizations->whereIn('id', $auth->organizations()->distinct()->allRelatedIds())->orWhere('user_id',$user->id);
        $organizations = $organizations->get();
        $cities = City::all();
        return view('patients.edit',compact('user', 'organizations', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFileRequest $request, $id)
    {
        $user = Patient::findOrFail($id);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'last_name2' => 'required',
            'email' => 'required|email|unique:patients,email,'. $user->id,
            'document' => 'required|unique:patients,document,'. $user->id,
            'address' => 'required',
            'city_id' => 'required',
        ]);

        $input = $request->all();

        if ($request->file('photo')) {
            $path = $request->file('photo')->store(
                'imgs/patients/' . $user->id,
                'uploads'
            );
            $input['photo'] = $path;
        }

        $user->update($input);
       
        $user->organizations()->sync($request->input('organizations'),false);

        return redirect()->route('patients.list')
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
        $user = Patient::findOrFail($id);
        $user->delete();
        return redirect()->route('patients.list')
            ->with('success', trans('locale.The item was deleted successfully'));
    }
}
