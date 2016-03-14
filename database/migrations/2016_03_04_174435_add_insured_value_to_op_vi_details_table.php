<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInsuredValueToOpViDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('op_vi_details', function (Blueprint $table) {
            $table->double('insured_value', 20, 2)->after('op_client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('op_vi_details', function (Blueprint $table) {
            //
        });
    }
}
