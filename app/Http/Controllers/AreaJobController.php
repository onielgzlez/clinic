<?php

namespace App\Http\Controllers;

use App\Http\Resources\AreaJobResource;
use App\Models\AreaJob;
use Illuminate\Http\Request;

class AreaJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

        return view('areas.index', ['total' => $totalU]);  
    }
}
