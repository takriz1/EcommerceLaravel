<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Review;
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
    public function AddReview(Request $request){



        $review = new Review();

        $review->rate = $request->rate;
        $review->content = $request->contenu;
        $review->user_id =  Auth::user()->id;
        $review->product_id =  $request->product_id;

        $review->save();

        return redirect()->back();

    }
    public function cart(){
        $categories = Category::all();
        $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();
        return view('guest.cart')->with('categories', $categories)->with('commande', $commande);
    }
    public function checkout(Request $request){
        $commande = Commande::find($request->commande);
        $commande->etat = "payee";
        $commande->update();
        return redirect('/client/dashboard')->with('success', 'votre produit est payer');

    }
    public function mesCommande(Request $request){
        return view('client.commande');

    }
    public function messageBlock(){
        return view('client.bloquer');
    }
}
