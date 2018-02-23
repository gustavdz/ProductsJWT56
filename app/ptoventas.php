<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class ptoventas extends Model
{
    //
    protected $table = 'ptoventas';
    protected $fillable = array('prefijo','prefijoSucursal','secuenciaFactura','secuenciaNC','user_id');
    protected $hidden = [];

    public function cabfacturas(){
        return $this->hasMany(cabfacturas::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
