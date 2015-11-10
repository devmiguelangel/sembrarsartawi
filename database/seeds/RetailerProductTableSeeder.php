<?php

use Sibas\Entities\RetailerProduct;

class RetailerProductTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new RetailerProduct();
    }

    protected function getData()
    {
        $data = [];

        $data[] = [
            'id' => date('U'),
            'ad_retailer_id'        => $this->getModelData('Retailer')->first()->id,
            'ad_company_product_id' => $this->getModelData('CompanyProduct')->first()->id,
            'type'      => 'MP',
            'billing'   => false,
            'provisional_certificate' => false,
            'modality'    => false,
            'facultative' => false,
            'ws'          => false,
            'landing'     => '',
            'questions'   => '',
            'active'      => true
        ];

        return $data;
    }
}
