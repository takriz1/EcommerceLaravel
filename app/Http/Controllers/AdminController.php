<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }
    public function profile(){
        return view('admin.profile');
    }
    public function EditProfile(Request $request){

        Auth::user()->name = $request->nom;
        Auth::user()->email = $request->mail;
        if($request->pw){
            Auth::user()->password = Hash::make($request->pw);
        }
        Auth::user()->update();
        return redirect('/admin/profile')->with('success','Profil Edited Successfully');

    }
}
