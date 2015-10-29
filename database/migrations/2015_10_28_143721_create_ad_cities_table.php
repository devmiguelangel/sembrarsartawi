<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 140);
            $table->string('abbreviation', 5);
            $table->enum('type', array_keys(\Config::get('base.city_types')));
            $table->string('slug', 140)->unique();
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
        Schema::drop('ad_cities');
    }
}
