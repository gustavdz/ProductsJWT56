<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Comunicados extends Model
{
    //
    Protected $table = 'comunicados';
    Protected $fillable = array('title','detail','user_id');
    protected $hidden = [];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function comunicadoslecturas(){
        return $this->hasMany(comunicadosLectura::class);
    }
}