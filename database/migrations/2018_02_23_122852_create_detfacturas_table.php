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
            $table->decimal('productPrecio',8,2);
            $table->integer('productCantidad');
            $table->decimal('productTotalBruto',8,2);
            $table->decimal('productTotalDscto',8,2);
            $table->decimal('productTotalTax1',8,2);
            $table->decimal('productTotalTax2',8,2);
            $table->decimal('productTotalNeto',8,2);
            $table->string('detfactEstado')->default('A');

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
