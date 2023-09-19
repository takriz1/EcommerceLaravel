<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function list(){
        $products = Product::all();
        return view('admin.products.index')->with('products', $products);
    }
    public function add(Request $request){


        $produit = new Product();
        $produit->name = $request->name;
        $produit->description = $request->description;
        $produit->price = $request->price;
        $produit->qtt = $request->qtt;


        $newname = uniqid();// unique name
        $image = $request->file('image');
        $newname.=".".$image->getClientOriginalExtension();// JPG
        $destinationPath = 'uploads';
        $image->move($destinationPath, $newname);

        $produit->image = $newname;
        if($produit->save()){
            return redirect()->back();
        }else{
            echo "error";
        }
    }

}
