<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at','desc')->get();
        return response()->json($products);
    }

    public function show($id){
        $product = Product::find($id);

        return response()->json($product);
    }

    public function create(Request $request){

        $product = new Product();

        $product->name     = $request->name;
        $product->price    = $request->price;
        $product->stock    = $request->stock;
        $product->category = $request->category;

        $product->save();

        return response()->json("Product Successfully Created!");

    }


    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json($product);
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        return response()->json('Product sucessfully deleted!');
    }

}
