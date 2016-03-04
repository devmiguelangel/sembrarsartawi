<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipationToOpViBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('op_vi_beneficiaries', function (Blueprint $table) {
            $table->double('participation', 5, 2)->after('relationship');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('op_vi_beneficiaries', function (Blueprint $table) {
            //
        });
    }
}
