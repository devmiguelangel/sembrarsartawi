<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', array_keys(\Config::get('base.product_types')));
            $table->string('name', 140);
            $table->string('slug', 5)->unique();
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
        Schema::drop('ad_products');
    }
}
