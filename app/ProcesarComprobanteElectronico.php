<?php

namespace Products_JWT;

use \SoapClient;


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
        //return $parameters;
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
