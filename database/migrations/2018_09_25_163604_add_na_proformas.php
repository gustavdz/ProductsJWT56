<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNaProformas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforms',function($table){
            $table->string('mensaje_resp',500)->nullable()->after('status_sri');
            $table->string('numero_autorizacion',200)->nullable()->after('mensaje_resp');
            $table->string('clave_acceso',200)->nullable()->after('numero_autorizacion');
            $table->dateTime('fecha_envio')->nullable()->after('clave_acceso');
            $table->string('fecha_autorizacion',20)->nullable()->after('fecha_envio');
            $table->string('prefijo_establecimiento',5)->nullable()->after('fecha_autorizacion');
            $table->string('prefijo_emision',5)->nullable()->after('prefijo_establecimiento');
            $table->string('secuencial',9)->nullable()->after('prefijo_emision');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proforms',function($table){
            $table->dropColumn([
                'mensaje_resp','numero_autorizacion','clave_acceso','fecha_envio','fecha_autorizacion','prefijo_establecimiento','prefijo_emision','secuencial'
            ]);
        });
    }
}
