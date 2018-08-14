<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class proform extends Model
{
    //
    Protected $table = 'proforms';
    Protected $fillable = array('type','total','total_iva','company','DNI','observations','duration','paidform','client_id','user_id');
    protected $hidden = [];

    public function client(){
        return $this->hasMany(Clients::class);
    }

    public function proformDetail(){
        return $this->hasMany(proformDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
