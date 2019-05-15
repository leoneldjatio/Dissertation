<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis;
use DB;

class GalleryController extends Controller
{


    public function create(){
        $theses = DB::table('theses')->orderBy('created_at','desc')->paginate(20);

        return view('pages.gallery',compact("theses"));
    }

    public function destroy(){
        $id = request('thesis_id');
        DB::table('theses')->where("thesis_id",$id)->delete();
        return redirect('/gallery')->with('success','Thesis Deleted Successfully');
    }

}
