<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    //
    Protected $table = 'empresas';
    Protected $fillable = array('razon_social','nombre_comercial','direccion_matriz','direccion_sucursal','ruc_empresa','user_id','telefono','logo','ambiente','secuencial_fact','secuencial_nc','prefijo_sucursal','prefijo_emision');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getLogoFilenameAttribute()
    {
        if (! $this->attributes['logo']) {
            return 'error';
        }
        return '/logo/users/'.$this->attributes['logo'];
    }
}
