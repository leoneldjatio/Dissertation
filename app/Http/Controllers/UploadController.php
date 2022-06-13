<?php

namespace App\Http\Controllers;
use App\Http\Requests\UploadRequest;
use App\Thesis;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload() {
        $faculties = DB::table('faculties')->orderBy('faculty_name')->get();
        $departments = DB::table('departments')->orderBy('department_name')->get();
        $categories = DB::table('categories')->orderBy('category_name')->get();
        return view('pages.upload',compact("faculties",'departments','categories'));
    }

    public function uploadSave(UploadRequest $request)
    {
        $this->validate($request, [
            'author',
            'supervisor',
            'title',
            'description',
            'file',
            'category_name',
            'number_of_pages',
            'options_options_id',
            'faculties_faculty_id',
            'year'

        ]);

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public',$filename);
            $url = Storage::url($path);


            $thesis = new Thesis();
            $thesis->author = request('author');
            $thesis->supervisor = request('supervisor');
            $thesis->title = request('title');
            $thesis->description = request('description');
            $thesis->file = $path;
            $thesis->category_name = request('category_name');
            $thesis->file_name = $url;
            $thesis->number_of_pages = request('number_of_pages');
            $thesis->department_name = request('department_name');
            $thesis->faculty_name = request('faculty_name');
            $thesis->year = request('year');


            $thesis->save();
        }
        return redirect('/gallery')->with('success','Thesis Successfully Uploaded');
    }

}
