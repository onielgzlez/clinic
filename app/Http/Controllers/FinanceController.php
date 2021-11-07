<?php

namespace App\Http\Controllers;

use App\Http\Resources\FinanceResource;
use App\Models\Finance;
use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = request()->user();
        $totalU = Finance::count();
        if (!$user->isAdmin())
            $totalU = Finance::whereRelation('organization', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organization', 'user_id', '=', $user->id)->count();

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

            $data = Finance::orderBy($field, $sDir)->offset($offset)->limit($perpage);
            if ($filter) $data = $data->where('type', 'like', "$filter%")->orWhere('user_id', 'like', "$filter%");

            if (!$user->isAdmin())
                $data = $data->whereRelation('organization', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organization', 'user_id', '=', $user->id);

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

            return response()->json(['meta' => $meta, 'data' => FinanceResource::collection($data)]);
        }

        return view('finances.index', ['total' => $totalU]);
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
        //$patients = Patient::orderBy('id', 'desc');
        if (!$user->isAdmin()){
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', $user->id);
            //$patients = $patients->whereRelation('organizations', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organizations', 'user_id', '=', $user->id);
        }            
        $organizations = $organizations->get();           
        //$patients = $patients->get();
        return view('finances.create', compact('user', 'organizations'));
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
            'type' => 'required',
            'amount' => 'required',
            'organization_id' => 'required',
            'user_id' => 'required',
        ]);

        $input = $request->all();
        Finance::create($input);

        return redirect()->route('finances.list')
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
        $user = Finance::findOrFail($id);
        return view('finances.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $finance = Finance::findOrFail($id);
        $user = request()->user();
        $organizations = Organization::orderBy('id', 'desc');
        //$patients = Patient::orderBy('id', 'desc');
        if (!$user->isAdmin()){
            $organizations = $organizations->whereIn('id', $user->organizations()->distinct()->allRelatedIds())->orWhere('user_id', $user->id);
            //$patients = $patients->whereRelation('organizations', 'id', 'IN', $user->organizations()->distinct()->allRelatedIds())->orWhereRelation('organizations', 'user_id', '=', $user->id);
        }            
        $organizations = $organizations->get();           
        //$patients = $patients->get();
        return view('finances.edit', compact('user','finance', 'organizations'));
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
        $user = Finance::findOrFail($id);
        $this->validate($request, [
            'type' => 'required',
            'amount' => 'required',
            'organization_id' => 'required',
            'user_id' => 'required',
        ]);

        $input = $request->all();

        $user->update($input);

        return redirect()->route('finances.list')
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
        $user = Finance::findOrFail($id);
        $user->delete();
        return redirect()->route('finances.list')
            ->with('success', trans('locale.The item was deleted successfully'));
    }
}
