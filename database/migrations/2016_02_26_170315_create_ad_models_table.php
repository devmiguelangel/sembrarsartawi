<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_make_id')->unsigned();
            $table->string('model', 140);
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('ad_make_id')->references('id')->on('ad_makes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad_models');
    }
}
