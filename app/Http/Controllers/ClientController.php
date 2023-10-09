<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //
    public function index(){
        return view('client.dashboard');
    }
    public function profile(){
        return view('client.profile');
    }
    public function EditProfile(Request $request){

        Auth::user()->name = $request->nom;
        Auth::user()->email = $request->mail;
        if($request->pw){
            Auth::user()->password = Hash::make($request->pw);
        }
        Auth::user()->update();
        return redirect('/client/profile')->with('success','Profil Edited Successfully');

    }
}
