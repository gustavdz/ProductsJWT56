<?php
class comprobanteGeneral {
  public $ambiente; // string
  public $claveAcc; // string
  public $codDoc; // string
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
  public $tipoEmision; // string
}

class facturaSRI extends comprobanteGeneral{
  public $detalles; // detalleFactura
  public $guiaRemision; // string
  public $identificacionComprador; // string
  public $importeTotal; // string
  public $infoAdicional; // campoAdicional
  public $moneda; // string
  public $pagos; // pago
  public $propina; // string
  public $razonSocialComprador; // string
  public $tipoIdentificacionComprador; // string
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
  public $codigo; // string
  public $codigoPorcentaje; // string
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

class notaCreditoSRI extends comprobanteGeneral{
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
                                    'factura' => 'facturaSRI',
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

    public function __construct($ambiente="1")
    {
        switch($ambiente){
            case "1":
                //$wsdl = "http://localhost:8080/MasterOffline/ProcesarComprobanteElectronico?wsdl";
                $wsdl = "http://167.172.254.184:8080/MasterOffline/ProcesarComprobanteElectronico?wsdl";
                break;
            case "2":
                $wsdl = "http://localhost:8080/MasterOffline_prod/ProcesarComprobanteElectronico?wsdl";
                break;
            default:
                $wsdl = "http://localhost:8080/MasterOffline_desa/ProcesarComprobanteElectronico?wsdl";
                break;
        }

        $options = array();
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
