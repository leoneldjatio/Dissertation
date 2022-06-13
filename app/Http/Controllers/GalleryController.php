<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis;
use DB;

class GalleryController extends Controller
{


    public function create(){
        $theses = DB::table('theses')->orderBy('created_at','desc')->paginate(10);
        $faculties = DB::table('faculties')->orderBy('faculty_name')->get();
        $departments = DB::table('departments')->get();

        return view('pages.gallery',compact("theses","faculties","departments"));
    }

    public function destroy(){
        $id = request('thesis_id');
        DB::table('theses')->where("thesis_id",$id)->delete();
        return redirect('/gallery')->with('success','Thesis Successfully Deleted');
    }

    public function department(Request $request)
    {
        $department = DB::table('departments')->where('faculties_faculty_name', $request->faculty)->orderBy('department_name')->get();
        return response()->json($department);
    }

    public function advanceSearch(){
        $query = request('department');
        $theses = DB::table('theses')->where('department_name',$query)->orderBy('created_at','desc')->paginate(10);
        $noResults = $theses;
        if($noResults->isEmpty()){

            return view('error.error', compact('query'));
        }
        $faculties = DB::table('faculties')->orderBy('faculty_name')->get();
        $departments = DB::table('departments')->get();
        return view('pages.gallery',compact("theses","faculties","departments"));
    }
}
