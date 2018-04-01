<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\Empresas;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class EmpresaController extends Controller
{
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $empresas = Empresas::where('user_id', $user->id)->get();//->paginate();
        return $empresas;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $empresa_request = $request->only('razon_social','nombre_comercial','direccion_matriz','direccion_sucursal','ruc_empresa');
        $empresa_request['user_id']=$user->id;
        $empresa = Empresas::create($empresa_request);
        return $empresa;
    }
    public function get($id){
        $empresa = Empresas::find($id);
        return $empresa;
    }
    public function edit($id, Request $request){
        $empresa = $this->get($id);
        $empresa -> fill($request->all())->save();
        return $empresa;
    }
    public function delete($id){
        $empresa = $this->get($id);
        $empresa->delete();
        return $empresa;
    }
}
