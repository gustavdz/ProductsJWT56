<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\detfacturas;
use JWTAuth;

class DetFacturasController extends Controller
{
    public function getAll($cabfacturas_id){
        $detfacturas = detfacturas::where('cabfactura_id', $cabfacturas_id)->get();//->paginate();
        return $detfacturas;
    }
    public function add(Request $request){
        $detfactura_request = $request->only('detfactura_secuencia','productPrecio','productCantidad','productTotalBruto','productTotalDscto','productTotalTax1','productTotalTax2','productTotalNeto','detfactEstado','products_id','cabfactura_id');
        $detfactura = detfacturas::create($detfactura_request);
        return $detfactura;
    }
    public function get($id){
        $detfactura = detfacturas::find($id);
        return $detfactura;
    }
    public function edit($id, Request $request){
        $detfactura = $this->get($id);
        $detfactura -> fill($request->all())->save();
        return $detfactura;
    }
    public function delete($id){
        $detfactura = $this->get($id);
        $detfactura->delete();
        return $detfactura;
    }
}
