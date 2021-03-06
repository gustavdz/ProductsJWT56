<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proform_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proform_id')->unsigned();
            $table->foreign('proform_id')->references('id')->on('proforms');
            $table->decimal('price',8,2);
            $table->decimal('iva',8,2)->default('12.00');
            $table->decimal('total',8,2);
            $table->integer('quantity')->default(1);
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('proform_details');
    }
}
