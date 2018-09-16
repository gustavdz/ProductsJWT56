<?php

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;

use SoapClient;
use SoapFault;

class ComprobanteGeneral extends Controller
{
    //
    public $ambiente; // string //[1,Prueba][2,Produccion]
    public $claveAcc; // string
    public $codDoc; // string //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
    public $configAplicacion; // configAplicacion
    public $configCorreo; // configCorreo
    public $contribuyenteEspecial; // string
    public $dirEstablecimiento; // string
    public $dirMatriz; // string
    public $establecimiento; // string
    public $fechaEmision; // string
    public $nombreComercial; // string
    public $obligadoContabilidad; // string
    public $ptoEmision; // string
    public $razonSocial; // string
    public $ruc; // string
    public $secuencial; // string
    public $tipoDoc; // string
    public $tipoEmision; // string //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
}

class factura extends ComprobanteGeneral{
    public $detalles; // detalleFactura
    public $guiaRemision; // string
    public $identificacionComprador; // string
    public $importeTotal; // string
    public $infoAdicional; // campoAdicional
    public $moneda; // string
    public $pagos; // pago
    public $propina; // string
    public $razonSocialComprador; // string
    public $tipoIdentificacionComprador; // string //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
    public $totalConImpuesto; // totalImpuesto
    public $totalDescuento; // string
    public $totalSinImpuestos; // string
}

class detalleFactura {
    public $cantidad; // string
    public $codigoAuxiliar; // string
    public $codigoPrincipal; // string
    public $descripcion; // string
    public $descuento; // string
    public $detalleAdicional; // detalleAdicional
    public $impuestos; // impuesto
    public $precioTotalSinImpuesto; // string
    public $precioUnitario; // string
}

class detalleAdicional {
    public $nombre; // string
    public $valor; // string
}

class impuesto {
    public $baseImponible; // string
    public $codigo; // string // [2, IVA][3,ICE][5, IRBPNR]
    public $codigoPorcentaje; // string // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
    public $tarifa; // string
    public $valor; // string
}

class campoAdicional {
    public $nombre; // string
    public $valor; // string
}

class totalImpuesto {
    public $baseImponible; // string
    public $codigo; // string
    public $codigoPorcentaje; // string
    public $descuentoAdicional; // string
    public $tarifa; // string
    public $valor; // string
}

class pago {
    public $formaPago; // decimal
    public $total; // decimal
}

class configAplicacion {
    public $dirAutorizados; // string
    public $dirFirma; // string
    public $dirLogo; // string
    public $passFirma; // string
}

class configCorreo {
    public $correoAsunto; // string
    public $correoHost; // string
    public $correoPass; // string
    public $correoPort; // string
    public $correoRemitente; // string
    public $sslHabilitado; // boolean
}

class guiaRemision {
    public $destinatarios; // destinatario
    public $dirPartida; // string
    public $fechaFinTransporte; // string
    public $fechaIniTransporte; // string
    public $infoAdicional; // campoAdicional
    public $placa; // string
    public $razonSocialTransportista; // string
    public $rise; // string
    public $rucTransportista; // string
    public $tipoIdentificacionTransportista; // string
}

class destinatario {
    public $codDocSustento; // string
    public $codEstabDestino; // string
    public $detalles; // detalleGuiaRemision
    public $dirDestinatario; // string
    public $docAduaneroUnico; // string
    public $fechaEmisionDocSustento; // string
    public $identificacionDestinatario; // string
    public $motivoTraslado; // string
    public $numAutDocSustento; // string
    public $numDocSustento; // string
    public $razonSocialDestinatario; // string
    public $ruta; // string
}

class detalleGuiaRemision {
    public $cantidad; // string
    public $codigoAdicional; // string
    public $codigoInterno; // string
    public $descripcion; // string
    public $detallesAdicionales; // detalleAdicional
}

class comprobanteRetencion {
    public $identificacionSujetoRetenido; // string
    public $impuestos; // impuestoComprobanteRetencion
    public $infoAdicional; // campoAdicional
    public $periodoFiscal; // string
    public $razonSocialSujetoRetenido; // string
    public $tipoIdentificacionSujetoRetenido; // string
}

class impuestoComprobanteRetencion {
    public $baseImponible; // string
    public $codDocSustento; // string
    public $codigo; // string
    public $codigoRetencion; // string
    public $fechaEmisionDocSustento; // string
    public $numDocSustento; // string
    public $porcentajeRetener; // string
    public $valorRetenido; // string
}

class notaDebitoSRI {
    public $codDocModificado; // string
    public $fechaEmisionDocSustento; // string
    public $identificacionComprador; // string
    public $impuestos; // impuesto
    public $infoAdicional; // campoAdicional
    public $motivos; // motivo
    public $numDocModificado; // string
    public $razonSocialComprador; // string
    public $rise; // string
    public $tipoIdentificacionComprador; // string
    public $totalSinImpuestos; // string
    public $valorTotal; // string
}

class motivo {
    public $razon; // string
    public $valor; // string
}

class notaCreditoSRI extends ComprobanteGeneral{
    public $codDocModificado; // string
    public $detalles; // detalleNotaCredito
    public $fechaEmisionDocSustento; // string
    public $identificacionComprador; // string
    public $infoAdicional; // campoAdicional
    public $moneda; // string
    public $motivo; // string
    public $numDocModificado; // string
    public $razonSocialComprador; // string
    public $rise; // string
    public $tipoIdentificacionComprador; // string
    public $totalConImpuesto; // totalImpuesto
    public $totalSinImpuestos; // string
    public $valorModificacion; // string
}

class detalleNotaCredito {
    public $cantidad; // string
    public $codigoAdicional; // string
    public $codigoInterno; // string
    public $descripcion; // string
    public $descuento; // string
    public $detallesAdicionales; // detalleAdicional
    public $impuestos; // impuesto
    public $precioTotalSinImpuesto; // string
    public $precioUnitario; // string
}

class comprobantePendiente {
    public $ambiente; // string
    public $codDoc; // string
    public $configAplicacion; // configAplicacion
    public $configCorreo; // configCorreo
    public $establecimiento; // string
    public $fechaEmision; // string
    public $ptoEmision; // string
    public $ruc; // string
    public $secuencial; // string
    public $tipoEmision; // string
}

class procesarComprobanteLote {
    public $comprobanteLote; // comprobanteLote

}

class comprobanteLote {
    public $ambiente; // string
    public $claveAcceso; // string
    public $codDoc; // string
    public $comprobantes; // comprobanteGeneral
    public $configAplicacion; // configAplicacion
    public $configCorreo; // configCorreo
    public $establecimiento; // string
    public $fechaEmision; // string
    public $idUnico; // string
    public $ptoEmision; // string
    public $ruc; // string
    public $secuencial; // string
    public $tipoEmision; // string
}

class procesarComprobanteLoteResponse {
    public $return; // respuestaComprobanteLote
}

class respuestaComprobanteLote {
    public $claveAccesoConsultada; // string
    public $error; // boolean
    public $mensajeGeneral; // mensajeGenerado
    public $respuestas; // respuesta
}

class mensajeGenerado {
    public $identificador; // string
    public $informacionAdicional; // string
    public $mensaje; // string
    public $tipo; // string
}

class respuesta {
    public $claveAcceso; // string
    public $comprobanteID; // string
    public $estadoComprobante; // string
    public $mensajes; // mensajeGenerado
    public $numeroAutorizacion; // string
}

class procesarComprobantePendiente {
    public $comprobantePendiente; // comprobantePendiente
}

class procesarComprobantePendienteResponse {
    public $return; // respuesta
}

class procesarComprobante {
    public $comprobante; // comprobanteGeneral
    public $envioSRI;
}

class procesarComprobanteResponse {
    public $return; // respuesta
}

class procesarComprobanteClaveContingencia {
    public $comprobante; // comprobanteGeneral
    public $claveContingencia; // string
}

class procesarComprobanteClaveContingenciaResponse {
    public $return; // respuesta
}


/**
 * ProcesarComprobanteElectronico class
 *
 *
 *
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class ProcesarComprobanteElectronico extends SoapClient
{
    private static $classmap =array(
        'factura' => 'factura',
        'comprobanteGeneral' => 'comprobanteGeneral',
        'detalleFactura' => 'detalleFactura',
        'detalleAdicional' => 'detalleAdicional',
        'impuesto' => 'impuesto',
        'pagos' => 'pagos',
        'campoAdicional' => 'campoAdicional',
        'totalImpuesto' => 'totalImpuesto',
        'configAplicacion' => 'configAplicacion',
        'configCorreo' => 'configCorreo',
        'guiaRemision' => 'guiaRemision',
        'destinatario' => 'destinatario',
        'detalleGuiaRemision' => 'detalleGuiaRemision',
        'comprobanteRetencion' => 'comprobanteRetencion',
        'impuestoComprobanteRetencion' => 'impuestoComprobanteRetencion',
        'notaDebito' => 'notaDebitoSRI',
        'motivo' => 'motivo',
        'notaCredito' => 'notaCreditoSRI',
        'detalleNotaCredito' => 'detalleNotaCredito',
        'comprobantePendiente' => 'comprobantePendiente',
        'procesarComprobanteLote' => 'procesarComprobanteLote',
        'comprobanteLote' => 'comprobanteLote',
        'procesarComprobanteLoteResponse' => 'procesarComprobanteLoteResponse',
        'respuestaComprobanteLote' => 'respuestaComprobanteLote',
        'mensajeGenerado' => 'mensajeGenerado',
        'respuesta' => 'respuesta',
        'procesarComprobantePendiente' => 'procesarComprobantePendiente',
        'procesarComprobantePendienteResponse' => 'procesarComprobantePendienteResponse',
        'procesarComprobante' => 'procesarComprobante',
        'procesarComprobanteResponse' => 'procesarComprobanteResponse',
        'procesarComprobanteClaveContingencia' => 'procesarComprobanteClaveContingencia',
        'procesarComprobanteClaveContingenciaResponse' => 'procesarComprobanteClaveContingenciaResponse',
    );

    public function ProcesarComprobanteElectronico($wsdl = "http://localhost:8080/MasterOffline/ProcesarComprobanteElectronico?wsdl", $options = array())
    {
        session_start();
        //if ( $_SESSION['ambiente'] == 1 )
        //    $wsdl = "http://localhost:8080/MasterOffline/ProcesarComprobanteElectronico?wsdl";
        foreach(self::$classmap as $key => $value) {
            if(!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }
        parent::__construct($wsdl, $options);
    }

    /**
     *
     *
     * @param procesarComprobanteClaveContingencia $parameters
     * @return procesarComprobanteClaveContingenciaResponse
     */
    public function procesarComprobanteClaveContingencia(procesarComprobanteClaveContingencia $parameters)
    {
        return $this->__soapCall('procesarComprobanteClaveContingencia', array($parameters), array('uri' => 'http://Servicio/','soapaction' => ''));
    }

    /**
     *
     *
     * @param procesarComprobante $parameters
     * @return procesarComprobanteResponse
     */
    public function procesarComprobante(procesarComprobante $parameters)
    {
        return $this->__soapCall('procesarComprobante', array($parameters), array('uri' => 'http://Servicio/','soapaction' => ''));
    }

    /**
     *
     *
     * @param procesarComprobanteLote $parameters
     * @return procesarComprobanteLoteResponse
     */
    public function procesarComprobanteLote(procesarComprobanteLote $parameters)
    {
        return $this->__soapCall('procesarComprobanteLote', array($parameters), array('uri' => 'http://Servicio/','soapaction' => ''));
    }

    /**
     *
     *
     * @param procesarComprobantePendiente $parameters
     * @return procesarComprobantePendienteResponse
     */
    public function procesarComprobantePendiente(procesarComprobantePendiente $parameters)
    {
        return $this->__soapCall('procesarComprobantePendiente', array($parameters), array('uri' => 'http://Servicio/','soapaction' => ''));
    }
}

/*
function enviar_factura_al_SRI($codigo, $cuantas,$ruta_documentosAutorizados, $enviar_sri, $enviar_al_titular, $estadoFac = 'P' )
{   session_start();

	if( $estadoFac == '' )
		$estadoFac = 'P';

	$mensaje_adicional = "";

	$facturaBD = new Factura();
	$detalleFact = array();
	$cabeceraFactura = array();
	// Consulta de la factura generada
	if ( $estadoFac == 'P' )
		$detalleFact = $facturaBD->get_facturaToFormatXML( $codigo );
	if ( ( $estadoFac == 'PC' ) || ( $estadoFac == 'PV' ) )
		$detalleFact = $facturaBD->get_facturaToFormatXMLandUpdateValues( $codigo, $_SESSION['puntVent_codigo'] );
	$cabeceraFactura = $detalleFact[0];
	$ambiente = $_SESSION['ambiente']; //[1,Prueba][2,Produccion]
	$tipoEmision = "1"; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema



	// Acumulo del detalle de la factura los valores CON  iva y los valores SIN iva para el detalle del impuesto posterior
	$baseImponibleConIVA = 0;   $baseImponibleSinIVA = 0;
	foreach ($detalleFact as $registro)
	{	if($registro["totalIVADetalle"]>0)
		{	$baseImponibleConIVA += $registro["precioTotalSinImpuesto"];
		}else
		{	$baseImponibleSinIVA += $registro["precioTotalSinImpuesto"];
		}
	}

	// Validación del tipo de identificación del comprador
	$tipoIdentificacionComprador = "";
	if( trim($cabeceraFactura['tipoIdentificacionComprador'])=="PAS" ){
		$tipoIdentificacionComprador = "06";
	}elseif ( trim($cabeceraFactura['tipoIdentificacionComprador'])=="CF" ){
		$tipoIdentificacionComprador = "07";
	}elseif ( trim($cabeceraFactura['tipoIdentificacionComprador'])=="IDE" ){
		$tipoIdentificacionComprador = "08";
	}elseif ( trim($cabeceraFactura['tipoIdentificacionComprador'])=="PLC" ){
		$tipoIdentificacionComprador = "09";
	}elseif ( trim($cabeceraFactura['tipoIdentificacionComprador'])=="CI" ){
		$tipoIdentificacionComprador = "05";
	}else{
		$tipoIdentificacionComprador = "04";
	}

	// 1.- Creo el objeto que interactua con el servicio web
	$procesarComprobanteElectronico = new ProcesarComprobanteElectronico();
	// 2.- Configuración de variables del sistema de facturación electrónica
	$configAplicacion = new configAplicacion();
	$configAplicacion->dirFirma = $_SESSION['rutallave'].$_SESSION['llaveactiva'];
	//$configAplicacion->dirFirma = "C:/inetpub/wwwroot/educalinksprod/finan/includes/gustavo_alfonso_decker_zambrano.p12";
	$configAplicacion->dirLogo = $_SESSION['dir_logo_cliente'];
	$configAplicacion->passFirma = $_SESSION['passllaveactiva'];
	// $configAplicacion->dirAutorizados = "C:/inetpub/wwwroot/educalinksprod/finan/documentos/autorizados";
	$configAplicacion->dirAutorizados = $ruta_documentosAutorizados;
	if($cabeceraFactura['emailTitular'] != '')
	{	$configCorreo = new configCorreo();
		$configCorreo->correoAsunto = "Notificación de documento electrónico generado";
		$configCorreo->correoHost = "smtp.gmail.com";
		$configCorreo->correoPass = "FACT2017elect@redlinks";
		$configCorreo->correoPort = "587";
		$configCorreo->correoRemitente = "facturaelectronica.redlinks@gmail.com";
		$configCorreo->sslHabilitado = true;
	}

	// 3.- Cabecera de la factura
	$factura = new factura();
	$factura->configAplicacion =  $configAplicacion;
	if($cabeceraFactura['emailTitular'] != '')
	{	$factura->configCorreo =  $configCorreo;
	}
	$factura->ambiente = $ambiente; //[1,Prueba][2,Produccion]
	$factura->tipoEmision = $tipoEmision; //[1,Emision Normal][2,Emision Por Indisponibilidad del sistema
	$factura->razonSocial = $cabeceraFactura['razonSocial']; //[Razon Social]
	if($cabeceraFactura['nombreComercial']!= ""){ $factura->nombreComercial = $cabeceraFactura['nombreComercial']; }  //[Nombre Comercial, si hay]*
	$factura->ruc = $cabeceraFactura['ruc']; //[Ruc]
	$factura->codDoc = "01"; //[01, Factura] [04, Nota Credito] [05, Nota Debito] [06, Guia Remision] [07, Guia de Retencion]
	$factura->establecimiento = $cabeceraFactura['prefijoSucursal']; // [Numero Establecimiento SRI]
	$factura->ptoEmision = $cabeceraFactura['prefijoPuntoVenta']; //[pto de emision ] **
	$factura->secuencial = $cabeceraFactura['secuencialComprobante']; // [Secuencia desde 1 (9)]
	$factura->fechaEmision = $cabeceraFactura['fechaEmision']; //[Fecha (dd/mm/yyyy)]
	$factura->dirMatriz = $cabeceraFactura['direccionMatriz']; //[Direccion de la Matriz ->SRI]
	$factura->dirEstablecimiento = $cabeceraFactura['direccionEstablecimiento']; //[Direccion de Establecimiento ->SRI]
	$factura->contribuyenteEspecial = $_SESSION['contribuyente_especial']; //[Ver SRI]
	$factura->obligadoContabilidad = "SI"; // [SI]
	$factura->tipoIdentificacionComprador = $tipoIdentificacionComprador; //Info comprador [04, RUC][05,Cedula][06, Pasaporte][07, Consumidor final][08, Exterior][09, Placa]
	$factura->razonSocialComprador = $cabeceraFactura['razonSocialComprador']; //Razon social o nombres y apellidos comprador
	$factura->identificacionComprador = $cabeceraFactura['identificacionComprador']; // Identificacion Comprador
	$factura->totalSinImpuestos =  number_format(($baseImponibleSinIVA+$baseImponibleConIVA),2,'.','');//number_format($cabeceraFactura['totalSinImpuestos'],2,'.',''); // Total sin aplicar impuestos
	$factura->totalDescuento = number_format($cabeceraFactura['totalDescuento'],2,'.',''); // Total Dtos
	// 4.- Impuestos de la cabecera
	$impuestosCabecera = array();
	// 4.1.- Acumulado del IVA 12%
	if($baseImponibleConIVA > 0)
	{	$totalIVA12 = new totalImpuesto();
		$totalIVA12->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
		$totalIVA12->codigoPorcentaje = "2"; // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
		$totalIVA12->baseImponible = number_format($baseImponibleConIVA, 2, '.', ''); // Suma de los impuesto del mismo cod y % (0.00)
		$totalIVA12->valor = number_format($cabeceraFactura['totalIVA'], 2, '.', ''); // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
		$impuestosCabecera[] = $totalIVA12;
	}
	// 4.2.- Acumulado del IVA 0%
	if($baseImponibleSinIVA > 0)
	{	$totalIVA0 = new totalImpuesto();
		$totalIVA0->codigo = "2"; // [2, IVA][3,ICE][5, IRBPNR]
		$totalIVA0->codigoPorcentaje = "0"; // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
		$totalIVA0->baseImponible = number_format($baseImponibleSinIVA, 2, '.', ''); // Suma de los impuesto del mismo cod y % (0.00)
		$totalIVA0->valor = number_format(0, 2, '.', ''); // Suma de los impuesto del mismo cod y % aplicado el % (0.00)
		$impuestosCabecera[] = $totalIVA0;
	}
	// 5.- Totales de la cabecera
	$factura->totalConImpuesto = $impuestosCabecera; //Agrega el impuesto a la factura
	$factura->propina = "0.00"; // Propina
	$factura->importeTotal = number_format($cabeceraFactura['totalImporte'],2,'.',''); // Total de Productos + impuestos
	$factura->moneda = "DOLAR";

	// 5.5.- Forma de pago
	$pagos = array();

	// Consulta de las formas de pago de la factura
	$pagosBD = $facturaBD->get_facturaToFormatXML_pagos( $codigo );

    //str_consultaFacturaToFormatXML_pagos
	--efectivo			-- SIN UTILIZACION DEL SISTEMA FINANCIERO
	--cheque			-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	--tarjeta de credito-- TARJETA DE CREDITO
	--deposito			-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	--transferencia		-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	--saldo a favor		-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	--documento interno	-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	--debito bancario	-- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
    --factura sin pago  -- OTROS CON UTILIZACION DEL SISTEMA FINANCIERO
	01 "SIN UTILIZACION DEL SISTEMA FINANCIERO";
	16 "TARJETA DE DEBITO";
	17 "DINERO ELECTRONICO";
	18 "TARJETA PREPAGO";
	19 "TARJETA DE CREDITO";
	20 "OTROS CON UTILIZACION DEL SISTEMA FINANCIERO";
	21 "ENDOSO DE TITULOS";

	$formaPago_aux = 0;

	foreach ($pagosBD as $formaPago)
	{   $pago = new pago();
		$pago->formaPago = $formaPago['formaPago'];
		$pago->total = $formaPago['pagoTotal'];
		$pagos [] = $pago;
		$formaPago_aux++;
	}
	if ($formaPago_aux == 0 )
	{   $pago = new pago();
		$pago->formaPago = 20;
		$pago->total = number_format( $cabeceraFactura['totalImporte'], 2, '.', '' );
		$pagos [] = $pago;
	}
	$factura->pagos = $pagos;

	// 6.- Detalle de la factura
	$detalle = array();
	foreach ($detalleFact as $linea)
	{	$detalleFactura = new detalleFactura();
		$detalleFactura->codigoPrincipal = $linea['codigoPrincipalProducto']; // Codigo del Producto
		//$detalleFactura->codigoAuxiliar = "1334D56789-A"; // Opcional
		$detalleFactura->descripcion = $linea['descripcionProducto']; // Nombre del producto
		$detalleFactura->cantidad = number_format($linea['cantidad'], 2, '.', ''); // Cantidad
		$detalleFactura->precioUnitario = number_format($linea['precioUnitario'], 2, '.', ''); // Valor unitario
		$detalleFactura->descuento = number_format($linea['descuentoDetalle'], 2, '.', ''); // Descuento u
		$detalleFactura->precioTotalSinImpuesto = number_format($linea['precioTotalSinImpuesto'], 2, '.', ''); // Valor sin impuesto

		// 6.1.- Impuesto del detalle
		$impuestoDetalle = array();
		$impuesto = new impuesto(); // Impuesto del detalle
		$impuesto->codigo = "2";
		$impuesto->codigoPorcentaje = ($linea['totalIVADetalle']>0? "2" : "0" );
		$impuesto->tarifa = ($linea['totalIVADetalle']>0? "12" : "0" );
		$impuesto->baseImponible = number_format($linea['precioTotalSinImpuesto'], 2, '.', '');
		$impuesto->valor = number_format($linea['totalIVADetalle'], 2, '.', '');
		$impuestoDetalle[] = $impuesto;
		// Agrego el impuesto al detalle
		$detalleFactura->impuestos = $impuestoDetalle;
		// Agrego el detalle
		$detalle[] = $detalleFactura;
	}
	// Agrego los detalles a la factura
	$factura->detalles = $detalle;
	$camposAdicionales = array();
	// 7.- Campos adicionales de la factura
	if ( $cabeceraFactura['adicional'] != '' )
	{   $campoAdicional = new campoAdicional();
		$campoAdicional->nombre = " ";
		$campoAdicional->valor = $cabeceraFactura['adicional'];
		$camposAdicionales[] = $campoAdicional;
	}
	if ( $cabeceraFactura['nombresAlumno'] != '' )
	{   $campoAdicional = new campoAdicional();
		$campoAdicional->nombre = "alumno";
		$campoAdicional->valor = "Codigo: ".$cabeceraFactura['codigoAlumno']." Nombres: ".$cabeceraFactura['nombresAlumno'];
		$camposAdicionales[] = $campoAdicional;
	}
	if($cabeceraFactura['emailTitular'] != '')
	{	$campoAdicional = new campoAdicional();
		$campoAdicional->nombre = "Email";
		$campoAdicional->valor = $cabeceraFactura['emailTitular'];
		$camposAdicionales[] = $campoAdicional;
	}
	else
	{	$campoAdicional = new campoAdicional();
		$campoAdicional->nombre = "Telefono";
		$campoAdicional->valor = $cabeceraFactura['telefonoTitular'];
		$camposAdicionales[] = $campoAdicional;
	}
	if ( $cabeceraFactura['nombresAlumno'] != '' )
	{   $campoAdicional = new campoAdicional();
		$campoAdicional->nombre = "Matricula";
		$campoAdicional->valor = $cabeceraFactura['registro'];
		$camposAdicionales[] = $campoAdicional;
	}
	$factura->infoAdicional = $camposAdicionales;
	$procesarComprobante = new procesarComprobante();
	$procesarComprobante->comprobante = $factura;
	if( $enviar_al_titular == true )
	{	$procesarComprobante->envioSRI = false; //nuevo campo, 2015-11-09.
		$mensaje_adicional = '<br><div align="center"<div class="callout callout-success"><h4><i class="fa fa-envelope"></i>&nbsp;</h4><p><i class="fa fa-check"></i>&nbsp;Documento electrónico enviado al e-mail del titular.</p></div>';
	}

	$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);

	if( $enviar_sri == true && $registro["estadoElectronico"] != 'AUTORIZADO' )
	{   if($res->return->estadoComprobante == "FIRMADO")
		{	$procesarComprobante = new procesarComprobante();
			$procesarComprobante->comprobante = $factura;
			$procesarComprobante->envioSRI = true;
			$mensaje_adicional.= '<br><div align="center"<div class="callout callout-success"><h4><i class="icon icon-sri"></i>&nbsp;</h4><p><i class="fa fa-check"></i>&nbsp;Documento enviado al SRI.</p></div>';
			$res = $procesarComprobanteElectronico->procesarComprobante($procesarComprobante);
		}
	}
	// Actualizo el estado en el comprobante
	$fact = new Factura();
	if( $enviar_sri == true )
	{	$fact->set_estadoElectronico($codigo, $res->return->estadoComprobante, $res->return->numeroAutorizacion, $res->return->claveAcceso, $tipoEmision, $ambiente);
	}
	$mensaje = (is_array($res->return->mensajes)? $res->return->mensajes[0]->mensaje : $res->return->mensajes->mensaje );
	if ($mensaje=='') $mensaje='-n/a-';
	$informacionAdicional = (is_array($res->return->mensajes)? $res->return->mensajes[0]->informacionAdicional : $res->return->mensajes->informacionAdicional );
	if ($informacionAdicional=='') $informacionAdicional='-n/a-';
	$numAutorizacion = (($res->return->numeroAutorizacion=='')? '-n/a-' : $res->return->numeroAutorizacion);
	$url = '../../documentos/autorizados/'.$_SESSION['directorio'].'/'.$cabeceraFactura['identificacionComprador'].'/FAC'.$cabeceraFactura['prefijoSucursal'].'-'.$cabeceraFactura['prefijoPuntoVenta'].'-'.str_pad($cabeceraFactura['secuencialComprobante'], 9, "0", STR_PAD_LEFT).'.pdf';
	$url2 = '../../documentos/autorizados/'.$_SESSION['directorio'].'/'.$cabeceraFactura['identificacionComprador'].'/FAC'.$cabeceraFactura['prefijoSucursal'].'-'.$cabeceraFactura['prefijoPuntoVenta'].'-'.str_pad($cabeceraFactura['secuencialComprobante'], 9, "0", STR_PAD_LEFT).'.xml';
	$documentosElectronicos =
							'<h5><b>Factura Electr&oacute;nica no. '.$cabeceraFactura['prefijoSucursal'].'-'.$cabeceraFactura['prefijoPuntoVenta'].'-'.str_pad($cabeceraFactura['secuencialComprobante'], 9, "0", STR_PAD_LEFT) . '<br><small>(Referencia interna no. '.$codigo.')</small></b></h5>'.
							'<a href="'.$url.'" target="_blank" ><small><i class="fa fa-file-pdf-o"></i> Ver en PDF</small></a> | '.
							'<a href="'.$url2.'" target="_blank"><small><i class="fa fa-file-code-o"></i> Ver en XML</small></a> | '.
							'<a href="'.$diccionario['ruta_html_finan'].'/finan/documento/imprimir/factura/'.$codigo.'" target="_blank"><small><i class="fa fa-globe"></i> Ver en internet</small></a><br>'.
							'<br><table width="100%"><tr><td width="25%" align="left"><b><small>Clave de Acceso:</b></td><td valign="top"><i><small>'.$res->return->claveAcceso.'</small></i></td></tr>'.
							'<tr><td align="left" valign="top"><b><small>No. de autorización:</b></td><td valign="top"><small>'.$numAutorizacion.'</small></td></tr>'.
							'<tr><td align="left" valign="top"><b><small>Estado:</small></b></td><td valign="top"><i><small>'.$res->return->estadoComprobante.'.</small></i></td></tr>'.
							'<tr><td colspan="2"><hr/></td></tr>'.
							'<tr><td align="left" valign="top"><b><small>Mensaje:</small></b></td><td valign="top"><i><small>'.$mensaje.'.</small></i></td></tr>'.
							'<tr><td align="left" valign="top"><b><small>Información adicional:</small></b></td><td valign="top"><i><small>'.$informacionAdicional.'.</small></i></td></tr>'.
							'</table>'.$mensaje_adicional;
	if( $cuantas == 'por lote' )
	{	$data['estado']  = $res->return->estadoComprobante;
		$data['detalle'] = $documentosElectronicos;
		return $data;
	}elseif($cuantas=='solo una')
	{	$data['listEBills'] = $documentosElectronicos;
		return $data;
	}
}
 */