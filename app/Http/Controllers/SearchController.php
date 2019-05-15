<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Symfony\Component\Translation\Dumper\QtFileDumper;

class SearchController extends Controller
{

    public function action(Request $request){
            $query = $request->get('query');
       // $department = DB::table('department')->where('department_name',$query)->get();
            if($query != ''){
               $data = DB::table('theses')
                   ->where('author','like','%'.$query.'%')
                   ->orwhere('title', 'like', '%'.$query.'%')
                   ->orWhere('supervisor','like','%'.$query.'%')
                   ->orWhere('category_name','like','%'.$query.'%')
                   ->orWhere('faculty_name','like','%'.$query.'%')
                   ->orWhere('department_name','like','%'.$query.'%')
                   ->orWhere('created_at','like','%'.$query.'%')
                   ->orderBy('created_at','desc')
                   ->paginate(10);


            }
            else{
                $data = DB::table('theses')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }
        $noResults = $data;
        if($noResults->isEmpty()){

            return view('error.error', compact('query'));
        }
        else {
            return view('pages.search', compact('data'));
        }
    }

}
