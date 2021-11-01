<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            ## Read value
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length"); // Rows display per page

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            // Total records
            $totalRecords = Subcategory::select('count(*) as allcount')->count();
            $totalRecordswithFilter = Subcategory::select('count(*) as allcount')->where('name', 'like', '%' . $search_arr . '%')->count();

            // Fetch records
            $name = $request->get('name');
            $status = $request->get('status');
            DB::enableQueryLog();
            $records = DB::table('subcategories')
                ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                ->where(function ($query) use ($name, $status) {
                    if ($name != '') {
                        $query->Where(function ($query) use ($name) {
                            $query->where('subcategories.name', 'like', '%' . $name . '%');
                        });
                    }
                    if ($status != '') {
                        $query->where(function ($query) use ($status) {
                            $query->where('subcategories.status', 'like', '%' . $status . '%');
                        });
                    }
                })
                ->where(function ($query) use ($search_arr) {
                    $query->orWhere(function ($query) use ($search_arr) {
                        $query->where('subcategories.name', 'like', '%' . $search_arr . '%');
                    });

                    $query->orWhere(function ($query) use ($search_arr) {
                        $query->where('categories.name', 'like', '%' . $search_arr . '%');
                    });
                })

                ->select('subcategories.*', 'categories.name as category_name')
                ->skip($start)
                ->take($rowperpage)
                ->orderBy($columnName, $columnSortOrder)
                ->get();

//            dd(DB::getQueryLog());

            $data = array();

            foreach ($records as $record) {
                $id = $record->id;
                $category_name = $record->category_name;
                $name = $record->name;
                $status = $record->status;

                $data[] = array(
                    "id" => $id,
                    "category_name" => $category_name,
                    "name" => $name,
                    "status" => $status
                );
            }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalRecordswithFilter,
                "data" => $data
            );

            return json_encode($response);

        }

        return view('subcategories');
    }
}
