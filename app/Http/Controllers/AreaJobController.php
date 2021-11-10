<?php

namespace App\Http\Controllers;

use App\Models;
use App\Http\Resources\AreaJobResource;
use App\Models\AreaJob;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AreaJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //Control de Roles
       /* if ($request->users == null) {
            return redirect('login');
        }
        $request->users()->roles(['administrador']);*/

       $areas['areas'] =AreaJob::all();   
       $totalU = AreaJob::count();
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

            $data = AreaJob::orderBy($field, $sDir)->offset($offset)->limit($perpage);
            if ($filter) $data = $data->where('name', 'like', "$filter%")->orWhere('description', 'like', "$filter%");
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

            return response()->json(['meta' => $meta, 'data' => AreaJobResource::collection($data)]);
        }

        return view('areas.index' ,$areas , ['total' => $totalU]);     
               
    }
    public static function getLevels(){
        $areas = AreaJob::all();  
        return $areas;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas =AreaJob::all(); 
        return view('areas.index',$areas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $areas = $request->except('_token');
        AreaJob::insert($areas);
    
        return redirect('areas');      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //        
        $areas = AreaJob::findOrFail($id);
        return view('areas.index' , compact('areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $areas = AreaJob::findOrFail($id);              
        $areas->update($request->all());  
        return redirect('areas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        AreaJob::destroy($id);
        return redirect('/areas')->with('mensaje','Area Eliminada');
    }
}
