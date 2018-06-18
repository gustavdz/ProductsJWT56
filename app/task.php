<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    Protected $table = 'tasks';
    Protected $fillable = array('id','title','detail','hours','points','complete','complete_date','proyecto_id','user_id');
    Protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function proyecto(){
        return $this->belongsTo(Proyectos::class);
    }

    public function getEstadoDescripcionAttribute()
    {
        switch ($this->complete) {
            case false:
                return "Pendiente";
                break;
            case true:
                return "Completado";
                break;

        }

    }
    public function getEstadoEtiquetaAttribute()
    {
        switch ($this->complete) {
            case false:
                return "warning";
                break;
            case true:
                return "success";
                break;
        }

    }
}
