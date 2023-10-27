<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    //
    public function AddCommand(Request $request){
       $commande = Commande::where('client_id', Auth::user()->id)->where('etat', 'en cours')->first();
       if($commande){
        $existe = false;
        foreach($commande->LigneCommandes as $lignec){
            if($lignec->product_id == $request->idproduct){
                $existe = true;
                $lignec->qte += $request->qte;
                $lignec->update();
            }
        }
        if(!$existe){ // $existe false
            $lc = new LigneCommande();
            $lc->qte = $request->qte;
            $lc->price = $request->price;
            $lc->product_id = $request->idproduct;
            $lc->commande_id = $commande->id;
            $lc->save();
        }

        return redirect('/client/cart')->with('success', 'Commande Ajouter');
    }else{
         // commande en cours n'existe pas
         $commande = new Commande();
         $commande->client_id = Auth::user()->id;
         if($commande->save()){
            $lc = new LigneCommande();
            $lc->qte = $request->qte;
            $lc->price = $request->price;
            $lc->product_id = $request->idproduct;
            $lc->commande_id = $commande->id;
            $lc->save();
            return redirect('/client/cart')->with('success', 'Commande Ajouter');
         }else{

            return redirect()->back()->with('error', 'impossible de commander le produit');
         }
}
}
    public function lcDestroy($idlc){
        $lc = LigneCommande::find($idlc);
        $lc->delete();
        return redirect()->back()->with('success', 'Commande Supprimer');
    }
}
