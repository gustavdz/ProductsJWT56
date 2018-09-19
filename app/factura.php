<?php

namespace Products_JWT;


class factura extends ComprobanteGeneral
{
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
