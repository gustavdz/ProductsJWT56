<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetfacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detfacturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detfactura_secuencia');
            $table->decimal('productPrecio');
            $table->integer('productCantidad');
            $table->decimal('productTotalBruto');
            $table->decimal('productTotalDscto');
            $table->decimal('productTotalTax1');
            $table->decimal('productTotalTax2');
            $table->decimal('productTotalNeto');
            $table->string('detfactEstado');

            //FK
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
            $table->integer('cabfactura_id')->unsigned();
            $table->foreign('cabfactura_id')->references('id')->on('cabfacturas');
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
        Schema::dropIfExists('detfacturas');
    }
}
