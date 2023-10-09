<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function home(){

        $categories = Category::all();
        $produits = Product::all();

        return view('guest.home')->with('categories', $categories)->with('produits', $produits);
    }
    public function details($id){
        $categories = Category::all();
        $product = Product::find($id);
        $products = Product::where('id','!=', $id)->get();

        return view('guest.product-details')->with('categories', $categories)->with('product', $product)->with('products', $products);
    }
    public function shop($id_cat){
        $category = Category::find($id_cat);
        $products = $category->products;
        $categories = Category::all();
        return view('guest.shop')->with('categories', $categories)->with('products', $products);
    }
    public function search(Request $request){
        $products = Product::where('name', 'LIKE', '%'.$request->keyword.'%')->get();
        $categories = Category::all();
        return view('guest.shop')->with('categories', $categories)->with('products', $products);
    }
}
