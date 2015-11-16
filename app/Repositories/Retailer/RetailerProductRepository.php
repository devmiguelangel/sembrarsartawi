<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\RetailerProduct;

class RetailerProductRepository
{
    public function getQuestionByProduct($rp_id)
    {
        $rp_id = decode($rp_id);

        $retailers = RetailerProduct::with(['productQuestions' => function($q){
            $q->where('active', true);
            $q->orderBy('order', 'asc');
        }])->where('id', $rp_id)->get();

        $questions = [];

        foreach ($retailers as $retailer) {
            foreach ($retailer->productQuestions as $productQuestion) {
                $check_yes = $productQuestion->response ? true : false;
                $check_no  = !$productQuestion->response ? true : false;

                $questions[] = [
                    'id'        => $productQuestion->question->id,
                    'order'     => $productQuestion->order,
                    'question'  => $productQuestion->question->question,
                    'response'  => $productQuestion->response,
                    'check_yes' => $check_yes,
                    'check_no'  => $check_no
                ];
            }
        }

        return $questions;
    }
}