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
               $theses = DB::table('theses')
                   ->where('author','like','%'.$query.'%')
                   ->orwhere('title', 'like', '%'.$query.'%')
                   ->orWhere('supervisor','like','%'.$query.'%')
                   //->orWhere('category_name','like','%'.$query.'%')
                   ->orWhere('faculty_name','like','%'.$query.'%')
                   ->orWhere('department_name','like','%'.$query.'%')
                   ->orWhere('created_at','like','%'.$query.'%')
                   ->orderBy('created_at','desc')
                   ->paginate(10);


            }
            else{
                $theses = DB::table('theses')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }
        $noResults = $theses;
        if($noResults->isEmpty()){

            return view('error.error', compact('query'));
        }
        else {
            $faculties = DB::table('faculties')->orderBy('faculty_name')->get();
            $departments = DB::table('departments')->get();

            return view('pages.gallery',compact("theses","faculties","departments"));
        }
    }

}