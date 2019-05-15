<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{


    public function view(){

     $url = Request::all();
     dd($url);
     $path = $url->path ;

     return view('pages.view',compact('path'));

    }
}
