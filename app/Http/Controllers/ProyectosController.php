<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Products_JWT\Proyectos;
use Products_JWT\User;

class ProyectosController extends Controller
{
    public function indexview(Request $request){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $proyectos = Proyectos::where('user_id', '=',$user->id)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('detail', 'LIKE', '%'.$search.'%');
            })
            ->paginate(10);
        return view('proyectos.show')->with(compact('proyectos'));
    }

    public function createview(){
        return view('proyectos.create');
    }

    public function store(Request $request){
        /*$messages =[
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
        $this->validate($request,$rules,$messages);*/

        $user = User::find(Auth::user()->id);
        $project_request = $request->only('title','detail','observations','client_id');
        $project_request['user_id']=$user->id;

        $proyectos = Proyectos::create($project_request);

        //return redirect('/clients');
        return redirect('/proyectos')->with('notification',['title'=>'Notificación','message'=>'Se agregó el cliente correctamente','alert_type'=>'info']);

    }
}
