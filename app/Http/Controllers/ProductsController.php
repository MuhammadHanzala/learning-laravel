<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\User;

class ProductsController extends Controller
{
    //
    public function index() {
            return Product::all();
    }

    public function show(Product $productId) {
        return $productId;
    }

    public function showByUserId($userId){
         $products =  Product::where('user_id', '=', $userId)->get();
        return response()->json(User::find($userId)->products);
        // return $products;
//        return $products;
    }

    public function store(Request $request){
        $input = '';
       if($request->isJson()){
           $input = $request->json()->all();
       }else {
           $input = $request->all();
       }
        $product = Product::create($input);
              
        return response()->json($product, 201);
    }

    public function update (Request $request, Product $product) {
        $input = '';
       if($request->isJson()){
           $input = $request->json()->all();
       }else {
           $input = $request->all();
       }
        $product->update($input);
        return response()->json($product, 200);
    }

    public function delete (Product $product) {
        $product->delete();
        return response()->json(null, 204);
    }
}
