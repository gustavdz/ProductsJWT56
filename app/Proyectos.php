<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    Protected $table = 'proyectos';
    Protected $fillable = array('id','title','detail','observations','fecha_inicio','fecha_fin','paidform','estado','last_state','client_id','user_id');
    Protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Clients::class);
    }

    public function tasks(){
        return $this->hasMany(task::class);
    }

    public function proforms(){
        return $this->hasMany(proform::class);
    }

    public function getEstadoDescripcionAttribute()
    {
        switch ($this->estado) {
            case 'P':
                return "Pendiente";
                break;
            case 'A':
                return "Activo";
                break;
            case 'T':
                return "Terminado";
                break;
            case 'E':
                return "Eliminado";
                break;
            case 'I':
                return "Inactivo";
                break;
            case 'C':
                return "Cancelado";
                break;
        }

    }
    public function getEstadoEtiquetaAttribute()
    {
        switch ($this->estado) {
            case 'P':
                return "info";
                break;
            case 'A':
                return "primary";
                break;
            case 'T':
                return "success";
                break;
            case 'I':
                return "warning";
                break;
            case 'C':
                return "danger";
                break;
            case 'E':
                return "danger";
                break;
        }

    }

    public function getPorcentAttribute(){

        $total = $this->tasks()->count();
        If ($total>0){
            $done = $this->tasks()->where('complete','=',true)->count();
            $porcent = ($done*100)/$total;
            return $porcent;
        }
        return 0;



    }
}
