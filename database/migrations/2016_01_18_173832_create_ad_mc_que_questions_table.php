<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdMcQueQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_mc_que_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ad_mc_certificate_questionnaire_id')->unsigned();
            $table->integer('ad_mc_question_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('ad_mc_certificate_questionnaire_id')->references('id')->on('ad_mc_cer_questionnaires');
            $table->foreign('ad_mc_question_id')->references('id')->on('ad_mc_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad_mc_certificate_questionnaire_questions');
    }
}
