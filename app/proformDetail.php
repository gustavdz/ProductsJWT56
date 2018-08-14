<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class proformDetail extends Model
{
    //
    Protected $table = 'proform_details';
    Protected $fillable = array('proform_id','price','iva','total','product_id');
    protected $hidden = [];

    public function Products(){
        return $this->hasMany(Products::class);
    }

    public function proform(){
        return $this->belongsTo(proform::class);
    }
}