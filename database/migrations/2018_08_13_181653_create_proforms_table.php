<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',1)->default('C');
            $table->decimal('total',8,2)->nullable();
            $table->decimal('total_iva',8,2)->nullable();
            $table->string('company',192);
            $table->string('DNI',192);
            $table->string('observations',1000)->nullable();
            $table->integer('duration')->default(15);
            $table->string('paidform',1000)->nullable();
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('proforms');
    }
}
