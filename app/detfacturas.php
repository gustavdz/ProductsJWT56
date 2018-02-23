<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class detfacturas extends Model
{
    //
    Protected $table = 'detfacturas';
    Protected $fillable = array('detfactura_secuencia','productPrecio','productCantidad','productTotalBruto','productTotalDscto','productTotalTax1','productTotalTax2','productTotalNeto','detfactEstado','products_id','cabfactura_id');
    protected $hidden = [];

    public function products(){
        return $this->belongsTo(Products::class);
    }

    public function cabfacturas(){
        return $this->belongsTo(cabfacturas::class);
    }
}
