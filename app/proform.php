<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class proform extends Model
{
    //
    Protected $table = 'proforms';
    Protected $fillable = array('types','subtotal12','subtotal0','subtotal','descuento','total','total_iva','company','DNI','observations','duration','paidform','client_id','proyecto_id','user_id','status','status_sri');
    protected $hidden = [];

    public function client(){
        return $this->belongsTo(Clients::class);
    }

    public function proformDetail(){
        return $this->hasMany(proformDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proyecto(){
        return $this->belongsTo(Proyectos::class);
    }

    public function getTypeAttribute()
    {
        switch ($this->types) {
            case 'P':
                return "Proveedor";
                break;
            case 'C':
                return "Cliente";
                break;
        }

    }
}
