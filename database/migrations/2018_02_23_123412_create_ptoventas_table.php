<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePtoventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ptoventas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prefijo',3);
            $table->string('prefijoSucursal',3);
            $table->integer('secuenciaFactura')->default(0);
            $table->string('secuenciaNC')->default(0);

            //FK
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ptoventas');
    }
}
