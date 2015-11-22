<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdRangePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_range_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_retailer_product_id')->unsigned();
            $table->integer('ad_city_id')->unsigned()->nullable();
            $table->integer('ad_agency_id')->unsigned()->nullable();
            $table->string('initial_policy', 140);
            $table->string('end_policy', 140);
            $table->timestamps();

            $table->foreign('ad_retailer_product_id')->references('id')->on('ad_retailer_products');
            $table->foreign('ad_city_id')->references('id')->on('ad_cities');
            $table->foreign('ad_agency_id')->references('id')->on('ad_agencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad_range_policies');
    }
}
