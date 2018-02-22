<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    //
    Protected $table='clients';
    Protected $fillable = array('name','last_name','email','dni','client_vip','phone','address','user_id');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
