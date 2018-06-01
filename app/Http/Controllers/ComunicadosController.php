<?php

namespace Products_JWT\Http\Controllers;

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
}