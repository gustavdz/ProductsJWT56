<?php

namespace Products_JWT;


class impuesto {
    public $baseImponible; // string
    public $codigo; // string // [2, IVA][3,ICE][5, IRBPNR]
    public $codigoPorcentaje; // string // IVA -> [0, 0%][2, 12%][3, 14%][6, No objeto de impuesto][7, Exento de IVA] ICE->[Tabla 19]
    public $tarifa; // string
    public $valor; // string
}
