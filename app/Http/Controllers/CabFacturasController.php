<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\cabfacturas;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;

class CabFacturasController extends Controller
{
    public function getAll(){
        $user = User::find(Auth::user()->id);
        $cabfacturas = cabfacturas::where('user_id', $user->id)->get();//->paginate();
        return $cabfacturas;
    }
    public function add(Request $request){
        $user = User::find(Auth::user()->id);
        $cabfactura_request = $request->only('razon_social','nombre_comercial','direccion_matriz','direccion_sucursal','ruc_empresa','numeroAutorizacion','fechaAutorizacion','tipoAmbiente','tipoEmision','PrefijoSucursal','PrefijoPuntoVenta','numeroFactura','clientTipoId','clientDNI','clientName','clientAddress','clientPhone','clientEmail','totalBruto','totalDscto','totalTax1','totalTax2','totalNeto','puntoVentaId','estadoElectronico','factEnviada','fechaEnvio','factEstado','clientId');
        $cabfactura_request['user_id']=$user->id;
        $cabfactura = cabfacturas::create($cabfactura_request);
        return $cabfactura;
    }
    public function get($id){
        $cabfactura = cabfacturas::find($id);
        return $cabfactura;
    }
    public function edit($id, Request $request){
        $cabfactura = $this->get($id);
        $cabfactura -> fill($request->all())->save();
        return $cabfactura;
    }
    public function delete($id){
        $cabfactura = $this->get($id);
        $cabfactura->delete();
        return $cabfactura;
    }
}
