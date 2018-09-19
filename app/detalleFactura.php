<?php

namespace Products_JWT;


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
