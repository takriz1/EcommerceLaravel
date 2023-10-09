<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function list(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products.index')->with('products', $products)->with('categories', $categories);
    }
    public function add(Request $request){


        $produit = new Product();
        $produit->name = $request->name;
        $produit->category_id = $request->categorie;
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

    public function update(Request $request){


        $produit = Product::find($request->idproduit);

        $produit->name = $request->name;
        $produit->description = $request->description;
        $produit->price = $request->price;
        $produit->qtt = $request->qtt;
        //upload image
        if($request->file('image')){

            // supprimer image precedent
            $file_path = public_path().'/uploads/'. $produit->image;
        unlink($file_path);

            //upload new image
             $newname = uniqid();// unique name
             $image = $request->file('image');
             $newname.=".".$image->getClientOriginalExtension();// JPG
            $destinationPath = 'uploads';
             $image->move($destinationPath, $newname);

        $produit->image = $newname;


        }


        if($produit->update()){
            return redirect()->back();
        }else{
            echo "error";
        }
    }

    public function destroy($id){
        $produit = Product::find($id);
        $file_path = public_path().'/uploads/'. $produit->image;
        unlink($file_path);
        if($produit->delete()){
            return redirect()->back();
        }else{
            echo "error";
        }
    }


}
