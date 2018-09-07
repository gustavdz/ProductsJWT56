<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubtotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforms',function($table){
            $table->decimal('subtotal12',8,2)->nullable()->after('types');
            $table->decimal('subtotal0',8,2)->nullable()->after('subtotal12');
            $table->decimal('subtotal',8,2)->nullable()->after('subtotal0');
            $table->decimal('descuento',8,2)->nullable()->after('subtotal');
        });
        Schema::table('proform_details',function($table){
            $table->decimal('descuento',8,2)->nullable()->after('price');
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
                'subtotal0','subtotal12','subtotal','descuento'
            ]);
        });
        Schema::table('proform_details',function($table){
            $table->dropColumn([
                'descuento'
            ]);
        });
    }
}
