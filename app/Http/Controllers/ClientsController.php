<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Clients;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\Http\Requests\ClientOwnershipRequest;
use Products_JWT\User;

class ClientsController extends Controller
{
    //api
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $clients = Clients::where('user_id', $user->id)->get();//->paginate();
        return $clients;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $client_request = $request->only('name','last_name','email','dni','phone','address');
        $client_request['user_id']=$user->id;
        $client = Clients::create($client_request);
        return $client;
    }
    public function get($id){
        $client = Clients::find($id);
        return $client;
    }
    public function edit($id, Request $request){
        $client = $this->get($id);
        $client -> fill($request->all())->save();
        return $client;
    }
    public function delete($id){
        $client = $this->get($id);
        $client->delete();
        return $client;
    }

    //web

    public function indexview(Request $request){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $clients = Clients::where('user_id', '=',$user->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('clients.show')->with(compact('clients'));
    }

    public function createview(){
        return view('clients.create');
    }

    public function store(Request $request)
    {

        $messages =[
            'name.required' => 'Es necesario ingresar un nombre para el cliente.',
            'last_name.required' => 'Es necesario ingresar un apellido para el cliente.',
            'email.required' => 'Es necesario ingresar un correo para el cliente.',
            'dni.required' => 'Es necesario ingresar un número de identificación para el cliente.',
            'phone.required' => 'Es necesario ingresar un teléfono para el cliente.',
            'address.required' => 'Es necesario ingresar una dirección para el cliente.',
            'profilepicture_filename.mimes' => 'Es necesario subir un archivo de tipo imagen',

        ];
        $rules = [
            'name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|max:200|unique:clients',
            'dni' => 'required|unique:clients',
            'address' => 'required',
            'phone' => 'required',
            'profilepicture_filename' => 'mimes:jpeg,jpg,png',

        ];
        $this->validate($request,$rules,$messages);

        if ($request->hasFile('profilepicture_filename')) {
            $file = $request->file('profilepicture_filename');
            $path = public_path('/images/clients');
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }else{
            $fileName=null;
        }

        $user = User::find(Auth::user()->id);
        $client_request = $request->only('name','last_name','email','dni','phone','address');
        $client_request['user_id']=$user->id;
        $client_request['profilepicture_filename']=$fileName;
        $client = Clients::create($client_request);

        //return redirect('/clients');
        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se agregó el cliente correctamente','alert_type'=>'info']);

    }
    public function getview(ClientOwnershipRequest $request, $id)
    {
        $clients = Clients::find($request->id);
        return view('clients.edit')->with(compact('clients'));
    }
    public function update(ClientOwnershipRequest $request, $id)
    {
        $messages =[
            'name.required' => 'Es necesario ingresar un nombre para el cliente.',
            'last_name.required' => 'Es necesario ingresar un apellido para el cliente.',
            'email.required' => 'Es necesario ingresar un correo para el cliente.',
            'dni.required' => 'Es necesario ingresar un número de identificación para el cliente.',
            'phone.required' => 'Es necesario ingresar un teléfono para el cliente.',
            'address.required' => 'Es necesario ingresar una dirección para el cliente.',

        ];
        $rules = [
            'name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|max:200',
            'dni' => 'required',
            'address' => 'required',
            'phone' => 'required'

        ];
        $this->validate($request,$rules,$messages);

        $cliente = Clients::find($request->id);
        $cliente->name = $request->input('name');
        $cliente->last_name = $request->input('last_name');
        $cliente->email = $request->input('email');
        $cliente->dni = $request->input('dni');
        $cliente->phone = $request->input('phone');
        $cliente->address = $request->input('address');
        $cliente->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se actualizaron los datos correctamente','alert_type'=>'info']);

    }
    public function update_picture(Request $request, $id)
    {
        $messages =[
            'profilepicture_filename.mimes' => 'Es necesario subir un archivo de tipo imagen',
            'profilepicture_filename.required' => 'Es necesario subir un archivo de tipo imagen',
            'profilepicture_filename.dimensions' => 'La imagen debe tener el mismo alto que ancho',
        ];
        $rules = [
            'profilepicture_filename' => 'required|mimes:jpeg,jpg,png|dimensions:ratio=2/2',

        ];
        $this->validate($request,$rules,$messages);

        if ($request->hasFile('profilepicture_filename')) {
            $file = $request->file('profilepicture_filename');
            $path = public_path('/images/clients');
            $fileName = uniqid() .'-'. $file->getClientOriginalName();
            $move = $file->move($path, $fileName);
        }

        $cliente = Clients::find($id);
        $cliente->profilepicture_filename = $fileName;
        $cliente->save();

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se actualizó la imagen correctamente','alert_type'=>'info']);

    }
    public function destroy(ClientOwnershipRequest $request,$id)
    {
        $cliente = Clients::find($request->id);
        $cliente->delete();

        return back();// formulario de registro
    }

    public function verJson()
    {
        $user = User::find(Auth::user()->id);

        $clientes = Clients::where('user_id', '=',$user->id)->get();

        return response()->json($clientes);// formulario de registro
    }
    public function modal()
    {
        return  view('clients.modal'); // formulario de registro
    }

}
