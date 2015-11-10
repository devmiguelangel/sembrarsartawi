<?php

use Sibas\Entities\CompanyProduct;

class CompanyProductTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new CompanyProduct();
    }

    protected function getData()
    {
        $data = [];

        $data[] = [
            'ad_company_id' => $this->getModelData('Company')->first()->id,
            'ad_product_id' => $this->getModelData('Product')->first()->id,
            'active'        => true
        ];

        return $data;
    }
}
