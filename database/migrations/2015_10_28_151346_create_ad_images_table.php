<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_retailer_id')->unsigned();
            $table->mediumText('description');
            $table->text('file');
            $table->enum('type', array_keys(config('base.retailer_image_types')));
            $table->timestamps();

            $table->foreign('ad_retailer_id')->references('id')->on('ad_retailers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad_images');
    }
}
