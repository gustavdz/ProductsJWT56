<?php

namespace Products_JWT;

class ComprobanteGeneral
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
