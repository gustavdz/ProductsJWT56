<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    Protected $table='products';
    Protected $fillable = array('name','detail','price');

}
