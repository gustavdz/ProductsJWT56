<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class comunicadosLectura extends Model
{

    Protected $table = 'comunicados_lecturas';
    Protected $fillable = array('user_id','comunicado_id','read','read_date');
    protected $hidden = [];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function comunicados(){
        //return $this->belongsToMany(Comunicados::class);
        return $this->belongsToMany(Comunicados::class, 'comunicados_lecturas');
    }
}
