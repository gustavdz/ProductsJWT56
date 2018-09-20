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
use ErrorException;

include("proc_comp_elec.php");

class ProformController extends Controller
{
    //

    public function getview(ProformOwnershipRequest $request){
        $proform = proform::find($request->proform_id);
        $proform->fecha_creacion = Carbon::parse($proform->created_at);
        return view('proformas.get')->with(compact('proform'));
    }

    public function sendSRI(ProformOwnershipRequest $request,$id,$proform_id){
        $proform = proform::find($proform_id);
        $user = User::find(Auth::user()->id);
        $perfil = Empresas::where('user_id', $user->id)->first();
        $client = Clients::where('id', $proform->client_id)->first();
        try{

            $factura = new \facturaSRI();

            $factura->ambiente=1; //string //[1,Prueba][2,Produccion]
            $factura->codDoc="01"; // string //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
            $factura->tipoEmision="1"; // string //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
            $factura->configAplicacion = new \configAplicacion(); // configAplicacion
            $factura->configCorreo= new \configCorreo(); // configCorreo
            $factura->dirEstablecimiento = $perfil->direccion_sucursal;
            $factura->dirMatriz = $perfil->direccion_matriz;
            $factura->nombreComercial = $perfil->nombre_comercial;
            $factura->razonSocial = $perfil->razon_social;
            $factura->ruc = $perfil->ruc_empresa;
            if($perfil->contribuyenteEspecial<>null || $perfil->contribuyenteEspecial<>''){
                $factura->contribuyenteEspecial = $perfil->contribuyenteEspecial;
            }
            $factura->establecimiento = '001';
            $factura->fechaEmision = date("d/m/Y");
            $factura->obligadoContabilidad = 'NO';
            $factura->ptoEmision='001';
            $factura->secuencial='000000001';

            $factura->configAplicacion->dirFirma=public_path('/cert/users/').$user->p12_filename;
            $factura->configAplicacion->dirAutorizados=public_path('/docauth/');
            $factura->configAplicacion->dirLogo=public_path($perfil->logo_filename);
            $factura->configAplicacion->passFirma=decrypt($user->p12_password);

            $factura->configCorreo->correoAsunto="Notificación de documento electrónico generado";
            $factura->configCorreo->correoHost="smtp.zoho.com";
            $factura->configCorreo->correoPass="Gustav0DZ123";
            $factura->configCorreo->correoPort="465";
            $factura->configCorreo->correoRemitente="info@ecuabill.com";
            $factura->configCorreo->sslHabilitado=true;

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
            $factura->tipoIdentificacionComprador=$tipo_id;
            $factura->identificacionComprador=$client->dni;
            $factura->razonSocialComprador=$client->company;
            $factura->totalSinImpuestos=number_format($proform->subtotal,2,'.','');
            $factura->totalDescuento=number_format($proform->descuento,2,'.','');

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

            $factura->totalConImpuesto = $impuestosCabecera; //Agrega el impuesto a la factura
            $factura->propina = "0.00"; // Propina
            $factura->importeTotal = number_format($proform->total,2,'.',''); // Total de Productos + impuestos
            $factura->moneda = "DOLAR";

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
            $factura->pagos=$pagos;

            $detalle = array();
            $detalleFact = array();

            $detalleFact= proformDetail::with('proform')->where('proform_id','=',$proform_id)->get();



            foreach ($detalleFact as $linea)
            {	$detalleFactura = new \detalleFactura();
                $detalleFactura->codigoPrincipal = "".$linea->product->id; // Codigo del Producto
                //$detalleFactura->codigoAuxiliar = ""; // Opcional
                $detalleFactura->descripcion = $linea->product->name.' - '.$linea->product->detail; // Nombre del producto
                $detalleFactura->cantidad = number_format($linea->quantity, 2, '.', ''); // Cantidad
                $detalleFactura->precioUnitario = number_format($linea->price, 2, '.', ''); // Valor unitario
                $detalleFactura->descuento = number_format($linea->descuento, 2, '.', ''); // Descuento u
                $detalleFactura->precioTotalSinImpuesto = "".(number_format($linea->quantity, 2, '.', '')*number_format($linea->price, 2, '.', '')); // Valor sin impuesto

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
            $campoAdicional->valor = $proform->observations;
            $camposAdicionales[] = $campoAdicional;

            $factura->infoAdicional = $camposAdicionales;

            $procesarComprobante = new \procesarComprobante();
            $procesarComprobante->comprobante = $factura;
            $procesarComprobante->envioSRI = false;
            var_dump($procesarComprobante);

            $procesarComprobanteElectronico = new \ProcesarComprobanteElectronico($factura->ambiente);
            $res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
            var_dump($res);

        }catch ( ErrorException $exception){
            echo $exception->getMessage();
        }

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

        return redirect()->back()->with('notification',['title'=>'Notificación','message'=>'Se creó la proforma correctamente','alert_type'=>'info']);

    }
}
