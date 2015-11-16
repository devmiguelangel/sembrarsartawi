<?php

use Sibas\Entities\RetailerProductQuestion;

class RetailerProductQuestionTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new RetailerProductQuestion();
    }

    protected function getData()
    {
        $data = [];

        $questions = $this->getModelData('Question')->all();

        foreach ($questions as $question) {
            $response = $question->id == 5 ? true : false;

            $data[] = [
                'ad_retailer_product_id' => $this->getModelData('RetailerProduct')->first()->id,
                'ad_question_id'         => $question->id,
                'order'                  => $question->id,
                'response'               => $response,
                'active'                 => true,
            ];
        }

        return $data;
    }
}
