<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Products;

class ProductsController extends Controller
{
    public function getAll(){
        $products = Products::all();
        return $products;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $product_request = $request->only('name','detail','price');
        $product_request['user_id']=$user->id;
        $product = Products::create($product_request);
        return $product;
    }
    public function get($id){
        $product = Products::find($id);
        return $product;
    }
    public function edit($id, Request $request){
        $product = $this->get($id);
        $product -> fill($request->all())->save();
        return $product;
    }
    public function delete($id){
        $product = $this->get($id);
        $product->delete();
        return $product;
    }
}
