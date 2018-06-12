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

    public function editview(Request $request){
        $proyecto = Proyectos::find($request->id);
        return view('proyectos.edit')->with(compact('proyecto'));
    }

    public function destroy(Request $request,$id)
    {
        $proyecto = Proyectos::find($id);
        $proyecto->delete();

        return back()->with('notification',['title'=>'Notificación','message'=>'Se eliminó el proyecto correctamente','alert_type'=>'warning']);
    }

    public function store(Request $request){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para el proyecto.',
            'title.min' => 'El nombre del proyecto debe tener mínimo 6 caracteres.',
            'cliente.required' => 'Es necesario seleccionar un cliente del proyecto.',
            'cliente.min' => 'Es necesario seleccionar un cliente del proyecto.',
            'detail.required' => 'Es necesario ingresar un detalle para el proyecto.',
            'detail.min' => 'El detalle del proyecto debe tener mínimo 10 caracteres.',


        ];
        $rules = [
            'title' => 'required|min:6',
            'cliente' => 'required|min:1',
            'detail' => 'required|min:10',

        ];
        $this->validate($request,$rules,$messages);

        $user = User::find(Auth::user()->id);
        $project_request = $request->only('title','detail','observations','paidform','client_id');
        $project_request['user_id']=$user->id;

        $proyectos = Proyectos::create($project_request);

        //return redirect('/clients');
        return redirect('/proyectos')->with('notification',['title'=>'Notificación','message'=>'Se agregó el proyecto correctamente','alert_type'=>'info']);

    }
    public function update(Request $request,$id){
        $messages =[
            'title.required' => 'Es necesario ingresar un nombre para el proyecto.',
            'title.min' => 'El nombre del proyecto debe tener mínimo 6 caracteres.',
            'cliente.required' => 'Es necesario seleccionar un cliente del proyecto.',
            'cliente.min' => 'Es necesario seleccionar un cliente del proyecto.',
            'detail.required' => 'Es necesario ingresar un detalle para el proyecto.',
            'detail.min' => 'El detalle del proyecto debe tener mínimo 10 caracteres.',


        ];
        $rules = [
            'title' => 'required|min:6',
            'cliente' => 'required|min:1',
            'detail' => 'required|min:10',

        ];
        $this->validate($request,$rules,$messages);

        $proyecto = Proyectos::find($id);
        $proyecto->title = $request->input('title');
        $proyecto->client_id = $request->input('client_id');
        $proyecto->detail = $request->input('detail');
        $proyecto->observations = $request->input('observations');
        $proyecto->paidform = $request->input('paidform');
        $proyecto->save();

        return redirect('/proyectos')->with('notification',['title'=>'Notificación','message'=>'Se editó el proyecto correctamente','alert_type'=>'info']);

    }
}
