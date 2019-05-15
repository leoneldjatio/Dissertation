<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create (){
        $users = DB::table('users')->get();
        $id = Auth::id();
        return view('pages.profile',compact('users','id'));
    }

    public function updateProfile(UserRequest $request,$id){
        $this->validate($request, [
            'name',
            'password',
        ]);

        $input = $request->all();

        $input['name'] = $request['name'];
        $input['email'] = $request['email'];
        $input['password'] = Hash::make($request['password']);

        User::find($id)->update($input);

       return redirect('gallery');
    }
}
