<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
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
    public function clients(){
        $clients = User::where('role','user')->get();
        return view('admin.clients.index')->with('clients', $clients);
    }
    public function block($iduser){
       $client = User::find($iduser);
       $client->active = false;
       $client->update();
       return redirect()->back()->with('success','client blocked');
    }
    public function active($iduser){
        $client = User::find($iduser);
        $client->active = true;
        $client->update();
        return redirect()->back()->with('success','client activated');
     }
     public function commandes(){
        $commande = Commande::all();
        return view('admin.commandes.dashboard')->with('commande', $commande);
     }

}

