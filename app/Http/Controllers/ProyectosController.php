<?php

namespace Products_JWT\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Products_JWT\Http\Requests\ProjectOwnershipRequest;
use Products_JWT\proform;
use Products_JWT\proformDetail;
use Products_JWT\Proyectos;
use Products_JWT\task;
use Products_JWT\User;
use Illuminate\Support\Facades\DB;


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

    public function indexproformasview(ProjectOwnershipRequest $request,$proyecto_id){
        $user = User::find(Auth::user()->id);

        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $proyecto = Proyectos::find($proyecto_id);

        $proformas = proform::where('proyecto_id','=',$proyecto_id)
            ->where(function ($query) use ($search) {
                $query->where('company', 'LIKE', '%'.$search.'%')
                    ->orWhere('DNI', 'LIKE', '%'.$search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('proformas.show')->with(compact('proformas','proyecto_id','proyecto'));
    }

    public function createview(){
        return view('proyectos.create');
    }

    public function editview(ProjectOwnershipRequest $request){
        $proyecto = Proyectos::find($request->id);
        return view('proyectos.edit')->with(compact('proyecto'));
    }

    public function getview(ProjectOwnershipRequest $request){
        $proyecto = Proyectos::find($request->id);
        $proyecto->fecha_inicio = Carbon::parse($proyecto->fecha_inicio);
        $proyecto->fecha_fin = Carbon::parse($proyecto->fecha_fin);
        return view('proyectos.get')->with(compact('proyecto'));
    }

    public function destroy(ProjectOwnershipRequest $request,$id)
    {
        try{
            DB::beginTransaction();
            $tareas = task::where('proyectos_id','=',$request->id)->get();
            foreach($tareas as $tarea) {
                $tarea->delete();
            }
            $proformas = proform::where('proyecto_id','=',$request->id)->get();
            foreach($proformas as $proforma){
                $proformadetalles = proformDetail::where('proform_id','=',$proforma->id)->get();
                foreach ($proformadetalles as $proformadetalle){
                    $proformadetalle->delete();
                }
                $proforma->delete();
            }
            $proyecto = Proyectos::find($request->id);
            $proyecto->delete();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('notification',['title'=>'Notificación','message'=>'Ocurrió un error al eliminar el proyecto','alert_type'=>'danger']);
        }
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
        $fecha_inicio=explode('-',$request->rangedate);
        $fecha_fin=explode('-',$request->rangedate);

        $user = User::find(Auth::user()->id);
        $project_request = $request->only('title','detail','observations','paidform','client_id');
        $project_request['fecha_inicio']=date("Ymd",strtotime(trim($fecha_inicio[0])));
        $project_request['fecha_fin']=date("Ymd",strtotime(trim($fecha_fin[1])));
        $project_request['user_id']=$user->id;

        $proyectos = Proyectos::create($project_request);

        //return redirect('/clients');
        return redirect('/proyectos')->with('notification',['title'=>'Notificación','message'=>'Se agregó el proyecto correctamente','alert_type'=>'info']);

    }
    public function update(ProjectOwnershipRequest $request,$id){
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
        $fecha_inicio=explode('-',$request->rangedate);
        $fecha_fin=explode('-',$request->rangedate);

        $proyecto = Proyectos::find($id);
        $proyecto->title = $request->input('title');
        $proyecto->client_id = $request->input('client_id');
        $proyecto->detail = $request->input('detail');
        $proyecto->observations = $request->input('observations');
        $proyecto->paidform = $request->input('paidform');
        $proyecto['fecha_inicio']=date("Ymd",strtotime(trim($fecha_inicio[0])));
        $proyecto['fecha_fin']=date("Ymd",strtotime(trim($fecha_fin[1])));
        $proyecto->save();

        return redirect('/proyectos')->with('notification',['title'=>'Notificación','message'=>'Se editó el proyecto correctamente','alert_type'=>'info']);

    }
}
