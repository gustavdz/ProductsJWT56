<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusAndStatussriProforms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proforms',function($table){
            $table->string('status',200)->nullable()->after('user_id');
            $table->string('status_sri',200)->nullable()->after('status');
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
                'status','status_sri'
            ]);
        });
    }
}
