<?php

namespace Products_JWT;

use Illuminate\Database\Eloquent\Model;

class cabfacturas extends Model
{
    //
    Protected $table ='cabfacturas';

    Protected $fillable = array('razon_social','nombre_comercial','direccion_matriz','direccion_sucursal','ruc_empresa','numeroAutorizacion','fechaAutorizacion','tipoAmbiente','tipoEmision','PrefijoSucursal','PrefijoPuntoVenta','numeroFactura','clientTipoId','clientDNI','clientName','clientAdress','clientPhone','clientEmail','totalBruto','totalDscto','totalTax1','totalTax2','totalNeto','puntoVentaId','estadoElectronico','factEnviada','fechaEnvio','factEstado','user_id','clientId');
    protected $hidden = [];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ptoventas(){
        return $this->belongsTo(ptoventas::class);
    }

    public function clients(){
        return $this->belongsTo(clients::class);
    }

    public function detfacturas(){
        return $this->hasMany(detfacturas::class);
    }
}
