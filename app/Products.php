<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    Protected $table = 'products';
    Protected $fillable = array('name','detail','price','user_id');
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cabfacturas(){
        return $this->hasMany(cabfacturas::class);
    }
}
