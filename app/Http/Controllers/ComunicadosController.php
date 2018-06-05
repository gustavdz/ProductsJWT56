<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Support\Facades\DB;
use JWTAuth;
use Illuminate\Http\Request;
use Products_JWT\Comunicados;
use Products_JWT\comunicadosLectura;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class ComunicadosController extends Controller
{
    public function createview(){
        return view('comunicados.create');
    }

    public function store(Request $request){
        $messages =[
            'title.required' => 'Es necesario ingresar un título para el comunicado.',
            'title.min'=> 'El título debe tener al menos 4 caracteres.',
            'title.max'=> 'El título debe tener máximo 200 caracteres.',
            'detail.required' => 'Es necesario ingresar un detalle para el comunicado.',
            'detail.max'=> 'El detalle debe tener máximo 500 caracteres.',
            'detail.min'=> 'El detalle debe tener al menos 4 caracteres.',
        ];
        $rules = [
            'title' => 'required|min:4|max:200',
            'detail' => 'required|min:4|max:500',
        ];
        $this->validate($request,$rules,$messages);

        $user = User::find(Auth::user()->id);
        $comunicado_request = $request->only('title','detail');
        $comunicado_request['user_id']=$user->id;
        $comunicado = Comunicados::create($comunicado_request);

        $users = User::get()->all();
        $contador=0;
        $cont_error=0;
        foreach ($users as $usuario){
            if($usuario->id != $user->id){
                $comunicado_lectura_values['user_id']=$usuario->id;
                $comunicado_lectura_values['comunicado_id']=$comunicado->id;
                $comunicado_lectura = comunicadosLectura::create($comunicado_lectura_values);
                if($comunicado_lectura != null){
                    $contador=$contador+1;
                }else{
                    $cont_error=$cont_error+1;
                }
            }
        }
        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se envió el comunicado correctamente a '.$contador.' usuarios, con '.$cont_error.' errores.','alert_type'=>'info']);
    }

    public function indexview(Request $request){
        if($request->search){
            $search=$request->search;
        }else{
            $search="";
        }

        $comunicados = Comunicados::
            leftjoin('comunicados_lecturas', 'comunicados_lecturas.comunicado_id', '=', 'comunicados.id')
            ->select('comunicados_lecturas.*', 'comunicados.title','comunicados.detail','comunicados.created_at as created','comunicados.updated_at as updated')
            ->where('comunicados_lecturas.user_id',Auth::user()->id)
            ->orderBy('comunicados_lecturas.read', 'ASC')
            ->orderBy('comunicados_lecturas.created_at', 'DESC')
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('detail', 'LIKE', '%'.$search.'%');
            })->paginate(10);
        return view('comunicados.show')->with(compact('comunicados'));
    }

    public function getview(Request $request, $id){

        $comunicado = comunicadosLectura::find($id);
        $comunicado->read=1;
        $comunicado->save();

        $comunicados = Comunicados::
        leftjoin('comunicados_lecturas', 'comunicados_lecturas.comunicado_id', '=', 'comunicados.id')
            ->select('comunicados_lecturas.*', 'comunicados.title','comunicados.detail','comunicados.created_at as created','comunicados.updated_at as updated')
            ->where('comunicados_lecturas.user_id',Auth::user()->id)
            ->where('comunicados_lecturas.id',$id);
        return view('comunicados.get')->with(compact('comunicados'));
    }
}
