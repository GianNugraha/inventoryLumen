<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::orderBy('created_at','desc')->get();
        return response()->json($transactions);
    }

    public function show($id){
        $transaction = Transaction::find($id);
        return response()->json($transaction);
    }

    public function create(Request $request){

        // check existing before transaction //
        $totAmount = 0;
        $product = Product::find($request->product_id);
        // end //

        if($product){

            if($request->quantity > $product->stock){
                return response()->json("Not Enough Stock!");
            }

            $product->stock = $product->stock - $request->quantity;
            $product->save();

            $totAmount = $product->price * $request->quantity;

            $transaction = new Transaction();

            $transaction->product_id     = $request->product_id;
            $transaction->quantity    = $request->quantity;
            $transaction->total_amount    = $totAmount;

            $transaction->save();

            return response()->json("Transaction Has Successfully Created!");
        }
        else{
            return response()->json("Product Not Found!");
        }

    }


    public function update(Request $request, $id){

        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;

        $product->save();

        return response()->json($product);
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        return response()->json('Product sucessfully deleted!');
    }

}
