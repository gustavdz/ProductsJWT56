<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use Products_JWT\detfacturas;
use JWTAuth;
use Illuminate\Http\Exceptions;

class DetFacturasController extends Controller
{
    public function getAll($cabfacturas_id){
        $detfacturas = detfacturas::where('cabfactura_id', $cabfacturas_id)->get();//->paginate();
        return $detfacturas;
    }
    public function simple_add(Request $request){
        $detfactura_request = $request->only('detfactura_secuencia','productPrecio','productCantidad','productTotalBruto','productTotalDscto','productTotalTax1','productTotalTax2','productTotalNeto','detfactEstado','products_id','cabfactura_id');
        $detfactura = detfacturas::create($detfactura_request);
        return $detfactura;

    }
    public function add(Request $request){

        $detfactura_request = $request->only('detfactura_secuencia','productPrecio','productCantidad','productTotalDscto','detfactEstado','products_id','cabfactura_id');
        $detfactura_request['productTotalBruto']=number_format($detfactura_request['productPrecio']*$detfactura_request['productCantidad'], 2, '.', ',');
        $detfactura_request['productTotalTax1']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])*0.12, 2, '.', ',');
        $detfactura_request['productTotalTax2']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])*0.10, 2, '.', ',');
        $detfactura_request['productTotalNeto']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])+$detfactura_request['productTotalTax1']+$detfactura_request['productTotalTax2'], 2, '.', ',');

        $detfactura = detfacturas::create($detfactura_request);
        return $detfactura;

    }
    public function get($id){
        $detfactura = detfacturas::find($id);
        return $detfactura;
    }
    public function simple_edit($id, Request $request){
        $detfactura = $this->get($id);
        $detfactura -> fill($request->all())->save();
        return $detfactura;
    }
    public function edit($id, Request $request){
        $detfactura = $this->get($id);

        $detfactura_request = $request->only('detfactura_secuencia','productPrecio','productCantidad','productTotalDscto','detfactEstado','products_id','cabfactura_id');
        $detfactura_request['productTotalBruto']=number_format($detfactura_request['productPrecio']*$detfactura_request['productCantidad'], 2, '.', ',');
        $detfactura_request['productTotalTax1']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])*0.12, 2, '.', ',');
        $detfactura_request['productTotalTax2']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])*0.10, 2, '.', ',');
        $detfactura_request['productTotalNeto']=number_format((($detfactura_request['productPrecio']*$detfactura_request['productCantidad'])-$detfactura_request['productTotalDscto'])+$detfactura_request['productTotalTax1']+$detfactura_request['productTotalTax2'], 2, '.', ',');

        $detfactura -> fill($detfactura_request)->save();
        return $detfactura;
    }
    public function delete($id){
        $detfactura = $this->get($id);
        $detfactura->delete();
        return $detfactura;
    }
}
