<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunicadosLecturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicados_lecturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->integer('comunicado_id')->unsigned();;
            $table->boolean('read')->default(false);
            $table->date('read_date')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('comunicado_id')->references('id')->on('comunicados');
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
        Schema::dropIfExists('comunicados_lecturas');
    }
}
