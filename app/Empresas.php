<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    //
    Protected $table = 'empresas';
    Protected $fillable = array('razon_social','nombre_comercial','direccion_matriz','direccion_sucursal','ruc_empresa','user_id');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
