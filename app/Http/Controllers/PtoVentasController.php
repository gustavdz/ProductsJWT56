<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\ptoventas;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class PtoVentasController extends Controller
{
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $ptoventas = ptoventas::where('user_id', $user->id)->get();//->paginate();
        return $ptoventas;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $ptoventa_request = $request->only('prefijo','prefijoSucursal','secuenciaFactura','secuenciaNC');
        $ptoventa_request['user_id']=$user->id;
        $ptoventa = ptoventas::create($ptoventa_request);
        return $ptoventa;
    }
    public function get($id){
        $ptoventa = ptoventas::find($id);
        return $ptoventa;
    }
    public function edit($id, Request $request){
        $ptoventa = $this->get($id);
        $ptoventa -> fill($request->all())->save();
        return $ptoventa;
    }
    public function delete($id){
        $ptoventa = $this->get($id);
        $ptoventa->delete();
        return $ptoventa;
    }
}
