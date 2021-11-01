<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->status=='Active'){
                        return '<span class="badge badge-primary">Active</span>';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>';
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == 'Active' || $request->get('status') == 'Deactive') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('name') != '' && !empty($request->get('name'))) {
                        $instance->where('name', $request->get('name'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%");
//                                ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('categories');
    }
}
