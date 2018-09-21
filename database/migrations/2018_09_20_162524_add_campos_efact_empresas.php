<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposEfactEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas',function($table){
            $table->string('ambiente',200)->default("1")->after('logo');
            $table->string('secuencial_fact',200)->nullable()->after('ambiente');
            $table->string('secuencial_nc',200)->nullable()->after('secuencial_fact');
            $table->string('prefijo_sucursal',200)->nullable()->after('secuencial_nc');
            $table->string('prefijo_emision',200)->nullable()->after('prefijo_sucursal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas',function($table){
            $table->dropColumn([
                'ambiente','secuencial_fact','secuencial_nc','prefijo_sucursal','prefijo_emision'
            ]);
        });
    }
}
