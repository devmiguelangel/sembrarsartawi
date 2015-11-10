<?php

use Sibas\Entities\RetailerUser;

class RetailerUserTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new RetailerUser();
    }

    protected function getData()
    {
        $data = [];

        $data[] = [
            'ad_retailer_id' => 1,
            'ad_user_id'     => $this->getModelData('User')->first()->id,
            'active'         => true
        ];

        return $data;
    }
}
