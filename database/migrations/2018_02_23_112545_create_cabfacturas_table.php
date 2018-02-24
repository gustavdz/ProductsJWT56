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
            $table->string('numeroAutorizacion')->nullable();
            $table->dateTime('fechaAutorizacion')->nullable();
            $table->string('tipoAmbiente')->default(2);
            $table->string('tipoEmision');
            $table->string('PrefijoSucursal',3);
            $table->string('PrefijoPuntoVenta',3);
            $table->string('numeroFactura')->nullable();
            $table->string('clientTipoId',3);
            $table->string('clientDNI',13);
            $table->string('clientName');
            $table->string('clientAdress')->nullable();
            $table->string('clientPhone');
            $table->string('clientEmail');
            $table->decimal('totalBruto',8,2);
            $table->decimal('totalDscto',8,2);
            $table->decimal('totalTax1',8,2);
            $table->decimal('totalTax2',8,2);
            $table->decimal('totalNeto',8,2);
            $table->integer('puntoVentaId');
            $table->string('estadoElectronico')->default('P');
            $table->boolean('factEnviada')->default(false);
            $table->dateTime('fechaEnvio')->nullable();
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
