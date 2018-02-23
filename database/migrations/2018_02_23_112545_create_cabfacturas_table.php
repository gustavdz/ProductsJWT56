<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabfacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabfacturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
            $table->string('nombre_comercial');
            $table->string('direccion_matriz');
            $table->string('direccion_sucursal');
            $table->string('ruc_empresa');
            $table->string('numeroAutorizacion');
            $table->dateTime('fechaAutorizacion');
            $table->string('tipoAmbiente');
            $table->string('tipoEmision');
            $table->string('PrefijoSucursal');
            $table->string('PrefijoPuntoVenta');
            $table->string('numeroFactura');
            //$table->integer('clientId');
            $table->string('clientTipoId');
            $table->string('clientDNI');
            $table->string('clientName');
            $table->string('clientAdress');
            $table->string('clientPhone');
            $table->string('clientEmail');
            $table->decimal('totalBruto');
            $table->decimal('totalDscto');
            $table->decimal('totalTax1');
            $table->decimal('totalTax2');
            $table->decimal('totalNeto');
            $table->integer('puntoVentaId');
            $table->string('estadoElectronico');
            $table->boolean('factEnviada')->default(false);
            $table->dateTime('fechaEnvio');
            $table->string('factEstado')->default('A');

            //FK
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('clientId')->unsigned();
            $table->foreign('clientId')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabfacturas');
    }
}
