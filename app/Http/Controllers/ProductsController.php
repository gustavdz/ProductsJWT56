<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Products;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class ProductsController extends Controller
{
    //api
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $products = Products::where('user_id', $user->id)->get(); //->paginate();
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

    //web

    public function indexview(Request $request){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $products = Products::where('user_id', '=',$user->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('detail', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('products.show')->with(compact('products'));
    }

    public function createview(){
        return view('products.create');
    }

    public function store(Request $request)
    {

        $messages =[
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min'=> 'El nombre del producto debe tener al menos 3 caracteres.',
            'detail.required' => 'Es necesario ingresar una descripción para el producto.',
            'detail.max'=> 'La descripción del producto debe tener máximo 200 caracteres.',
            'price.required' => 'Es necesario ingresar un precio para el producto.',
            'price.numeric'=> 'Es necesario valores numéricos para el precio',
            'price.min'=> 'El precio del producto no puede ser negativo.',
            'picture_filename.mimes' => 'Es necesario subir un archivo de tipo imagen',
            'picture_filename.required' => 'Es necesario subir un archivo de tipo imagen',
            'picture_filename.dimensions' => 'La imagen debe tener el mismo alto que ancho',
        ];
        $rules = [
            'name' => 'required|min:3',
            'detail' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'picture_filename' => 'mimes:jpeg,jpg,png|dimensions:ratio=2/2',
        ];
        $this->validate($request,$rules,$messages);

        if ($request->hasFile('picture_filename')) {
            $file = $request->file('picture_filename');
            $path = public_path('/images/products');
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }else{
            $fileName=null;
        }

        $user = User::find(Auth::user()->id);
        $product_request = $request->only('name','detail','price');
        $product_request['user_id']=$user->id;
        $product_request['picture_filename']=$fileName;
        $product = Products::create($product_request);

        return redirect('/products');

    }
    public function getview($id)
    {
        $products = Products::find($id);
        return view('products.edit')->with(compact('products'));
    }
    public function update(Request $request, $id)
    {
        $messages =[
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min'=> 'El nombre del producto debe tener al menos 3 caracteres.',
            'detail.required' => 'Es necesario ingresar una descripción para el producto.',
            'detail.max'=> 'La descripción del producto debe tener máximo 200 caracteres.',
            'price.required' => 'Es necesario ingresar un precio para el producto.',
            'price.numeric'=> 'Es necesario valores numéricos para el precio',
            'price.min'=> 'El precio del producto no puede ser negativo.',
        ];
        $rules = [
            'name' => 'required|min:3',
            'detail' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request,$rules,$messages);

        $product = Products::find($id);
        $product->name = $request->input('name');
        $product->detail = $request->input('detail');
        $product->price = $request->input('price');

        $product->save();

        return redirect('/products');

    }
    public function update_picture(Request $request, $id)
    {
        $messages =[
            'picture_filename.mimes' => 'Es necesario subir un archivo de tipo imagen',
            'picture_filename.required' => 'Es necesario subir un archivo de tipo imagen',
            'picture_filename.dimensions' => 'La imagen debe tener el mismo alto que ancho',
        ];

        $rules = [
            'picture_filename' => 'required|mimes:jpeg,jpg,png|dimensions:ratio=2/2',
        ];
        $this->validate($request,$rules,$messages);

        if ($request->hasFile('picture_filename')) {
            $file = $request->file('picture_filename');
            $path = public_path('/images/products');
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }

        $product = Products::find($id);
        $product->picture_filename = $fileName;
        $product->save();

        return redirect('/products');

    }
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();

        return back();
    }
}
