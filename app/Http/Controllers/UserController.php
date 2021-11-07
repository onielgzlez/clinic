<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\AreaJob;
use App\Models\City;
use App\Models\Classificator;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalU = User::count();
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

            $data = User::orderBy($field, $sDir)->offset($offset)->limit($perpage);
            if ($filter) $data = $data->where('first_name', 'like', "$filter%")->orWhere('last_name', 'like', "$filter%")
                ->orWhere('email', 'like', "$filter%")->orWhere('type', 'like', "$filter%");
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

            return response()->json(['meta' => $meta, 'data' => UserResource::collection($data)]);
        }

        return view('users.index', ['total' => $totalU]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $areas = AreaJob::all();
        $cities = City::all();
        $classifications = Classificator::where('type', 'worker')->get();
        return view('users.create', compact('roles', 'areas', 'cities', 'classifications'));
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
            'email' => 'required|email|unique:users,email',
            //'document' => 'required|document|unique:users',
            'password' => 'same:confirm-password',
        ]);       

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }       

        $input['headerTheme'] = $request->input('headerTheme') ? 'dark' : 'light';
        $input['sideTheme'] = $request->input('sideTheme') ? 'dark' : 'light';
        $input['desktopTheme'] = $request->input('desktopTheme') ? 'dark' : 'light';
        $input['brandTheme'] = $request->input('brandTheme') ? 'dark' : 'light';        

        $user = User::create($input);
        if ($request->file('photo')) {
            $path = $request->file('photo')->store(
                'imgs/avatars/' . $user->id,
                'uploads'
            );
            $user->update(['photo'=>$path]);
        }        
        $user->roles()->detach();
        $user->roles()->attach($request->input('roles'));

        return redirect()->route('users.list')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *     
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('users.profile');
    }

    /**
     * Display the specified resource.
     *     
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        return view('users.overview');
    }

    /**
     * Display the specified resource.
     *     
     * @return \Illuminate\Http\Response
     */
    public function personal()
    {
        return view('users.personal');
    }

    /**
     * Display the specified resource.
     *     
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('users.account');
    }

    /**
     * Display the specified resource.
     *     
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('users.password');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $areas = AreaJob::all();
        $cities = City::all();
        $classifications = Classificator::where('type', 'worker')->get();
        return view('users.edit', compact('user', 'roles', 'areas', 'cities', 'classifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreFileRequest  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'last_name2' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'document' => 'required|unique:users,document,' . $user->id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if ($request->file('photo')) {
            $path = $request->file('photo')->store(
                'imgs/avatars/' . $user->id,
                'uploads'
            );
            $input['photo'] = $path;
        }

        $input['headerTheme'] = $request->input('headerTheme') ? 'dark' : 'light';
        $input['sideTheme'] = $request->input('sideTheme') ? 'dark' : 'light';
        $input['desktopTheme'] = $request->input('desktopTheme') ? 'dark' : 'light';
        $input['brandTheme'] = $request->input('brandTheme') ? 'dark' : 'light';

        $user->update($input);

        $user->roles()->detach();
        $user->roles()->attach($request->input('roles'));

        return redirect()->route('users.list')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.list')
            ->with('success', 'User deleted successfully');
    }
}
