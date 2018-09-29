<?php

namespace Products_JWT\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Products_JWT\Clients;
use Products_JWT\Empresas;
use Products_JWT\Http\Requests\ProformOwnershipRequest;
use Products_JWT\Http\Requests\ProjectOwnershipRequest;
use Products_JWT\proform;
use Products_JWT\proformDetail;
use Products_JWT\Proyectos;
use Products_JWT\User;
use JWTAuth;
use Exception;

include("proc_comp_elec.php");

class ProformController extends Controller
{
    //

    public function getview(ProformOwnershipRequest $request){
        $proform = proform::find($request->proform_id);
        $proform->fecha_creacion = Carbon::parse($proform->created_at);
        return view('proformas.get')->with(compact('proform'));
    }

    public function autorizar_factura_al_SRI($proform_id){
        try{
            $proform = proform::find($proform_id);
            $user = User::find(Auth::user()->id);
            $perfil = Empresas::where('user_id', $user->id)->first();
            $client = Clients::where('id', $proform->client_id)->first();

            $tipo_id="";//[04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
            if($client->tipo_id == "CI"){
                $tipo_id="05";
            }elseif ($client->tipo_id == "RUC"){
                $tipo_id="04";
            }elseif ($client->tipo_id == "PAS"){
                $tipo_id="06";
            }elseif ($client->tipo_id == "PLC"){
                $tipo_id="09";
            }else{
                $tipo_id="07";
            }


            // 1.- Creo el objeto que interactua con el servicio web
            $procesarComprobanteElectronico = new \ProcesarComprobanteElectronico($perfil->ambiente);

            // 2.- Configuración de variables del sistema de facturación electrónica
            $configAplicacion = new \configAplicacion();
            $configAplicacion->dirFirma=public_path('/cert/users/').$user->p12_filename;
            $configAplicacion->dirAutorizados=public_path('/docauth/');
            $configAplicacion->dirLogo=public_path($perfil->logo_filename);
            $configAplicacion->passFirma=decrypt($user->p12_password);

            if($client->email != '')
            {	$configCorreo = new \configCorreo();
                $configCorreo->correoAsunto="Notificación de documento electrónico generado";
                $configCorreo->correoHost=env('MAIL_HOST');
                $configCorreo->correoPass= env('MAIL_PASSWORD');  //"vNr3224e9Mrf";
                $configCorreo->correoPort=env('MAIL_PORT');
                $configCorreo->correoRemitente=env('MAIL_USERNAME');
                $configCorreo->sslHabilitado=true;
            }

            $comprobantesPendientes = new \comprobantePendiente();
            $comprobantesPendientes->ambiente = $perfil->ambiente; //[1,Prueba][2,Produccion]
            $comprobantesPendientes->codDoc = "01"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
            $comprobantesPendientes->configAplicacion =  $configAplicacion;
            if($client->email != ''){
                $comprobantesPendientes->configCorreo =  $configCorreo;
            }
            $comprobantesPendientes->establecimiento = $perfil->prefijo_sucursal; // [Numero Establecimiento SRI]
            $comprobantesPendientes->fechaEmision = date("d/m/Y");
            $comprobantesPendientes->ptoEmision = $perfil->prefijo_emision; //[pto de emision ] **
            $comprobantesPendientes->ruc = $perfil->ruc_empresa; //[Ruc]
            $comprobantesPendientes->secuencial = str_pad($proform->secuencial,9,"0",STR_PAD_LEFT); // [Secuencia desde 1 (9)]
            //$comprobantesPendientes->secuencial = str_pad($perfil->secuencial_fact,9,"0",STR_PAD_LEFT); // [Secuencia desde 1 (9)]
            $comprobantesPendientes->tipoEmision = "1"; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema

            $procesarComprobante = new \procesarComprobantePendiente();
            $procesarComprobante->comprobantePendiente = $comprobantesPendientes;
            $res = $procesarComprobanteElectronico->procesarComprobantePendiente($procesarComprobante);

            $proform->status_sri=$res->return->estadoComprobante;

            $proform->numero_autorizacion=$res->return->numeroAutorizacion;
            $proform->clave_acceso=$res->return->claveAcceso;

            if($res->return->estadoComprobante == 'AUTORIZADO'){
                $proform->fecha_autorizacion=$res->return->fechaAutorizacion;
                $proform->mensaje_resp="OK";
            }else{
                $proform->mensaje_resp=$res->return->mensajes->mensaje;
            }
            $proform->save();

            $data=array();
            $data['status']="OK";
            $data['respuesta']=$res;
            return $data;
        }catch(Exception $e){
            $data['status']="ERROR";
            $data['respuesta']=$e->getMessage();
            return $data;
        }
    }

    public function enviar_factura_al_SRI($proform_id)
    {
        try{
            $enviar_sri=1;

            $mensaje_adicional = "";

            $proform = proform::find($proform_id);
            $user = User::find(Auth::user()->id);
            $perfil = Empresas::where('user_id', $user->id)->first();
            $client = Clients::where('id', $proform->client_id)->first();

            $tipo_id="";//[04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
            if($client->tipo_id == "CI"){
                $tipo_id="05";
            }elseif ($client->tipo_id == "RUC"){
                $tipo_id="04";
            }elseif ($client->tipo_id == "PAS"){
                $tipo_id="06";
            }elseif ($client->tipo_id == "PLC"){
                $tipo_id="09";
            }else{
                $tipo_id="07";
            }


            // 1.- Creo el objeto que interactua con el servicio web
            $procesarComprobanteElectronico = new \ProcesarComprobanteElectronico($perfil->ambiente);

            // 2.- Configuración de variables del sistema de facturación electrónica
            $configAplicacion = new \configAplicacion();
            $configAplicacion->dirFirma=public_path('/cert/users/').$user->p12_filename;
            $configAplicacion->dirAutorizados=public_path('/docauth/');
            $configAplicacion->dirLogo=public_path($perfil->logo_filename);
            $configAplicacion->passFirma=decrypt($user->p12_password);


            if($client->email != '')
            {	$configCorreo = new \configCorreo();
                $configCorreo->correoAsunto="Notificación de documento electrónico generado";
                $configCorreo->correoHost=env('MAIL_HOST');
                $configCorreo->correoPass= env('MAIL_PASSWORD');  //"vNr3224e9Mrf";
                $configCorreo->correoPort=env('MAIL_PORT');
                $configCorreo->correoRemitente=env('MAIL_USERNAME');
                $configCorreo->sslHabilitado=true;
            }

            // 3.- Cabecera de la factura
            $factura = new \facturaSRI();

            $factura->configAplicacion =  $configAplicacion;
            $factura->configCorreo =  $configCorreo;

            $factura->ambiente=$perfil->ambiente; //string //[1,Prueba][2,Produccion]
            $factura->codDoc="01"; // string //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
            $factura->tipoEmision="1"; // string //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema

            $factura->dirEstablecimiento = $perfil->direccion_sucursal;
            $factura->dirMatriz = $perfil->direccion_matriz;
            $factura->nombreComercial = $perfil->nombre_comercial;
            $factura->razonSocial = $perfil->razon_social;
            $factura->ruc = $perfil->ruc_empresa;
            if($perfil->contribuyenteEspecial<>null || $perfil->contribuyenteEspecial<>''){
                $factura->contribuyenteEspecial = $perfil->contribuyenteEspecial;
            }
            $factura->obligadoContabilidad = 'NO';
            $factura->establecimiento = $perfil->prefijo_sucursal;
            $factura->fechaEmision = date("d/m/Y");
            $factura->ptoEmision=$perfil->prefijo_emision;
            $factura->secuencial=str_pad($perfil->secuencial_fact,9,"0",STR_PAD_LEFT);


            $factura->tipoIdentificacionComprador=$tipo_id;
            $factura->identificacionComprador=$client->dni;
            $factura->razonSocialComprador=$client->company;
            $factura->totalSinImpuestos=number_format($proform->subtotal,2,'.','');
            $factura->totalDescuento=number_format($proform->descuento,2,'.','');

            // 4.- Impuestos de la cabecera
            $impuestosCabecera = array();
            if($proform->subtotal12 > 0)
            {	$totalIVA12 = new \totalImpuesto();
                $totalIVA12->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
                $totalIVA12->codigoPorcentaje = "2"; // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
                $totalIVA12->baseImponible = number_format($proform->subtotal12, 2, '.', ''); // Suma de los impuesto del mismo cod y % (0.00)
                $totalIVA12->valor = number_format($proform->total_iva, 2, '.', ''); // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
                $impuestosCabecera[] = $totalIVA12;
            }
            if($proform->subtotal0 > 0)
            {	$totalIVA0 = new \totalImpuesto();
                $totalIVA0->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
                $totalIVA0->codigoPorcentaje = "0"; // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
                $totalIVA0->baseImponible = number_format($proform->subtotal0, 2, '.', ''); // Suma de los impuesto del mismo cod y % (0.00)
                $totalIVA0->valor = number_format(0, 2, '.', ''); // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
                $impuestosCabecera[] = $totalIVA0;
            }

            // 5.- Totales de la cabecera
            $factura->totalConImpuesto = $impuestosCabecera; //Agrega el impuesto a la factura
            $factura->propina = "0.00"; // Propina
            $factura->importeTotal = number_format($proform->total,2,'.',''); // Total de Productos + impuestos
            $factura->moneda = "DOLAR";

            // 5.5.- Forma de pago
            /*01 "SIN UTILIZACION DEL SISTEMA FINANCIERO";
            16 "TARJETA DE DEBITO" --EFECTIVO;
            17 "DINERO ELECTRONICO";
            18 "TARJETA PREPAGO";
            19 "TARJETA DE CREDITO" --TARJETA CREDITO;
            20 "OTROS CON UTILIZACION DEL SISTEMA FINANCIERO";
            21 "ENDOSO DE TITULOS";*/

            $pagos = array();
            $pago = new \pago();
            $pago->formaPago = "20";
            $pago->total = $proform->total;
            $pagos [] = $pago;
            $factura->pagos = $pagos;

            // 6.- Detalle de la factura
            $detalle = array();
            $detalleFact= proformDetail::with('proform')->where('proform_id','=',$proform_id)->get();

            foreach ($detalleFact as $linea)
            {	$detalleFactura = new \detalleFactura();
                $detalleFactura->codigoPrincipal = "".$linea->product->id; // Codigo del Producto
                //$detalleFactura->codigoAuxiliar = ""; // Opcional
                $detalleFactura->descripcion = $linea->product->name.' - '.$linea->product->detail; // Nombre del producto
                $detalleFactura->cantidad = number_format($linea->quantity, 2, '.', ''); // Cantidad
                $detalleFactura->precioUnitario = number_format($linea->price, 2, '.', ''); // Valor unitario
                $detalleFactura->descuento = number_format((number_format($linea->descuento)/100)*(number_format($linea->quantity,2,'.',',')*number_format($linea->price, 2, '.', '')),2,'.',','); // Descuento u
                $detalleFactura->precioTotalSinImpuesto = (number_format($linea->quantity, 2, '.', '')*number_format($linea->price, 2, '.', ''))-$detalleFactura->descuento; // Valor sin impuesto

                // 6.1.- Impuesto del detalle [2, IVA][3,ICE][5, IRBPNR]
                //IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
                $impuestoDetalle = array();
                $impuesto = new \impuesto(); // Impuesto del detalle
                $impuesto->codigo = "2";
                switch($linea->iva){
                    case 12:
                        $impuesto->codigoPorcentaje = "2";
                        $impuesto->tarifa = "12";
                        $impuesto->baseImponible = number_format($detalleFactura->precioTotalSinImpuesto, 2, '.', '');
                        $impuesto->valor = number_format((($detalleFactura->precioTotalSinImpuesto*12)/100),2,'.','');
                        break;
                    case 0:
                        $impuesto->codigoPorcentaje = "0";
                        $impuesto->tarifa = "0";
                        $impuesto->baseImponible = number_format($detalleFactura->precioTotalSinImpuesto, 2, '.', '');
                        $impuesto->valor = 0;
                        break;
                    default:
                        $impuesto->codigoPorcentaje = "2";
                        $impuesto->tarifa = "12";
                        $impuesto->baseImponible = number_format($detalleFactura->precioTotalSinImpuesto, 2, '.', '');
                        $impuesto->valor = number_format((($detalleFactura->precioTotalSinImpuesto*12)/100),2,'.','');
                        break;
                }
                $impuestoDetalle[] = $impuesto;
                // Agrego el impuesto al detalle
                $detalleFactura->impuestos = $impuestoDetalle;
                // Agrego el detalle
                $detalle[] = $detalleFactura;
            }
            // Agrego los detalles a la factura
            $factura->detalles = $detalle;

            // 7.- Campos adicionales de la factura
            $camposAdicionales = array();
            $campoAdicional = new \campoAdicional();
            $campoAdicional->nombre = "Observación: ";
            if($proform->observations == null || $proform->observations==""){
                $info_adicional="N-A";
            }else{
                $info_adicional=$proform->observations;
            }
            $campoAdicional->valor = $info_adicional;
            $camposAdicionales[] = $campoAdicional;

            $factura->infoAdicional = $camposAdicionales;

            $procesarComprobante = new \procesarComprobante();
            $procesarComprobante->comprobante = $factura;
            $procesarComprobante->envioSRI = false;
            $data=array();
            $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

            if($res->return->estadoComprobante == "FIRMADO"){
                $proform->status_sri="PROCESANDOSE";
                $proform->save();
            }else{
                $data['status']="ERROR";
                $data['respuesta']="NO SE LOGRO FIRMAR EL COMPROBANTE";
                return $data;
            }
            if ($client->email != ''){
                $facturastring='FAC'.$procesarComprobante->comprobante->establecimiento.'-'.$procesarComprobante->comprobante->ptoEmision.'-'.$procesarComprobante->comprobante->secuencial;
                $email = new MailController();
                $email->send_factura($client->name.' '.$client->lastname
                    ,$facturastring
                    ,[
                        public_path('docauth/'.$client->dni.'/'.$facturastring.'.pdf')
                        ,public_path('docauth/'.$client->dni.'/'.$facturastring.'.xml')
                    ]
                    ,$client->email
                );
            }

            if( $enviar_sri == 1 ) {
                if($res->return->estadoComprobante == "FIRMADO"){
                    $procesarComprobante->envioSRI = true;
                    $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
                    $proform->secuencial=$factura->secuencial;
                    $proform->prefijo_emision=$factura->ptoEmision;
                    $proform->fecha_envio=date('Y-m-d H:i:s');
                    $proform->prefijo_establecimiento=$factura->establecimiento;
                    $proform->status_sri=$res->return->estadoComprobante;
                    $proform->numero_autorizacion=$res->return->numeroAutorizacion;
                    if($res->return->estadoComprobante == 'AUTORIZADO'){
                        $proform->fecha_autorizacion=$res->return->fechaAutorizacion;
                        $proform->mensaje_resp="OK";
                    }else{
                        $proform->mensaje_resp=$res->return->mensajes->mensaje;
                    }
                    $proform->save();

                    $perfil->secuencial_fact=$perfil->secuencial_fact+1;
                    $perfil->save();
                }
            }
            $data['status']="OK";
            $data['respuesta']=$res;
            return $data;
        }catch(Exception $e){
            $data['status']="ERROR";
            $data['respuesta']=$e->getMessage();
            return $data;
        }
    }

    public function sendSRI(ProformOwnershipRequest $request,$id,$proform_id){
        $data = $this->enviar_factura_al_SRI($proform_id);
        var_dump($data);
        //return redirect()->route('indexProformweb',['id' => $id])->with('notification',['title'=>'Notificación','message'=>$data['respuesta']->return->estadoComprobante,'alert_type'=>'info']);

    }

    public function resendSRI(ProformOwnershipRequest $request,$id,$proform_id){
        $data = $this->autorizar_factura_al_SRI($proform_id);
        return redirect()->route('indexProformweb',['id' => $id])->with('notification',['title'=>'Notificación','message'=>$data['respuesta']->return->estadoComprobante,'alert_type'=>'info']);

    }

    public function delete(ProformOwnershipRequest $request,$id,$proform_id){

        $proform_details = proformDetail::where('proform_id','=',$request->proform_id);
        $proform_details->delete();

        $proform = proform::find($request->proform_id);
        $proform->delete();

        return back()->with('notification',['title'=>'Notificación','message'=>'Se eliminó la proforma correctamente','alert_type'=>'warning']);
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
        $proform_request['subtotal12']=$request->subtotal12;
        $proform_request['subtotal0']=$request->subtotal0;
        $proform_request['subtotal']=$request->subtotal0 + $request->subtotal12;
        $proform_request['descuento']=$request->dscto;
        $proform_request['total']=$request->subtotal12 + $request->subtotal0 + $request->iva;
        $proform_request['total_iva']=$request->iva;
        $proform_request['company']=$request->company;
        $proform_request['DNI']=$request->dni;
        $proform_request['observations']=$request->observations;
        $proform_request['duration']=$request->duration;
        $proform_request['paidform']=$request->paidform;
        $proform_request['client_id']=$request->client_id;
        $proform_request['user_id']=$user->id;
        $proform_request['status']="NO PAGADA";
        $proform_request['status_sri']="NO ENVIADA";
        $proform_request['proyecto_id']=$id;

        $proform = proform::create($proform_request);

        $detail_request_product = json_decode($request->details);

        foreach($detail_request_product->details as $product){
            $detail_request['price'] = $product->Precio;
            $detail_request['iva'] = $product->IVA;
            $detail_request['product_id'] = $product->Producto;
            $detail_request['quantity'] = $product->Cantidad;
            $detail_request['total'] = $product->Total;
            $detail_request['descuento'] = $product->Descuento;
            $detail_request['proform_id'] = $proform->id;

            $proform_detalle = proformDetail::create($detail_request);
        }

        $proyecto = Proyectos::find($id);

        //return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se creó la proforma correctamente','alert_type'=>'info']);
        //return view('proformas.show')->with(compact('proyecto','proyecto_id'));
        return redirect()->route('indexProformweb',['id' => $proyecto->id])->with('notification',['title'=>'Notificación','message'=>'Se creó la proforma correctamente','alert_type'=>'info']);
    }
}
