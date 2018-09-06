<?php

namespace Products_JWT\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Products_JWT\Http\Requests\ProformOwnershipRequest;
use Products_JWT\Http\Requests\ProjectOwnershipRequest;
use Products_JWT\proform;
use Products_JWT\proformDetail;
use Products_JWT\Proyectos;
use Products_JWT\User;
use JWTAuth;

class ProformController extends Controller
{
    //

    public function getview(ProformOwnershipRequest $request){
        $proform = proform::find($request->proform_id);
        $proform->fecha_creacion = Carbon::parse($proform->created_at);
        return view('proformas.get')->with(compact('proform'));
    }

    public function createview(ProjectOwnershipRequest $request){
        $proyecto = Proyectos::find($request->id);
        return view('proformas.create')->with(compact('proyecto'));
    }
    public function store(Request $request,$id){

        $messages =[
            'cliente.required' => 'Es necesario ingresar un cliente o proveedor.',
            'duration.required' => 'Es necesario ingresar una duración de la proforma.',
            'duration.min' => 'La duración mínima de la proforma es de 1 día.',
            'duration.max' => 'La duración máxima de la proforma es de 60 días.',
            'duration.numeric' => 'La duración debe ser un número',
            'company.required' => 'Es necesario ingresar un nombre de empresa o razón social.',
            'dni.required' => 'Es necesario ingresar una identificación de la empresa.',
            'paidform.required' => 'Es necesario ingresar una forma de pago.',
            'total.required' => 'Es necesario ingresar al menos un producto con precio.',
            'total.numeric' => 'Las proformas deben ser mayor a 0.',
            'total.min' => 'Las proformas deben ser mayor a 0.',
            'details.min' => 'Debe ingresar al menos un producto.',
            'details.required' => 'Debe ingresar al menos un producto.',
        ];
        $rules = [
            'cliente' => 'required|min:1',
            'duration' => 'required|min:1|numeric|max:30',
            'company' => 'required|min:1',
            'dni' => 'required|min:1',
            'paidform' => 'required|min:1',
            'total' => 'required|min:1|numeric',
            'details' => 'required|min:14'
        ];
        $this->validate($request,$rules,$messages);

        $user = User::find(Auth::user()->id);
        $proform_request['types']=$request->types;
        $proform_request['total']=$request->subtotal12 + $request->subtotal0;
        $proform_request['total_iva']=$request->iva;
        $proform_request['company']=$request->company;
        $proform_request['DNI']=$request->dni;
        $proform_request['observations']=$request->observations;
        $proform_request['duration']=$request->duration;
        $proform_request['paidform']=$request->paidform;
        $proform_request['client_id']=$request->client_id;
        $proform_request['user_id']=$user->id;
        $proform_request['proyecto_id']=$id;

        $proform = proform::create($proform_request);

        $detail_request_product = json_decode($request->details);

        foreach($detail_request_product->details as $product){
            $detail_request['price'] = $product->Precio;
            $detail_request['iva'] = $product->IVA;
            $detail_request['product_id'] = $product->Producto;
            $detail_request['quantity'] = $product->Cantidad;
            $detail_request['total'] = $product->Total;
            $detail_request['proform_id'] = $proform->id;

            $proform_detalle = proformDetail::create($detail_request);
        }

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se agregó el producto correctamente','alert_type'=>'info']);

    }
}
