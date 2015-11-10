<?php

use Illuminate\Support\Str;
use Sibas\Entities\Product;

class ProductTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new Product();
    }

    protected function getData()
    {
        $data = [];

        $name = 'Desgravamen';
        $data[] = [
            'type' => 'PH',
            'name' => $name,
            'code' => 'de',
            'slug' => Str::slug($name)
        ];

        return $data;
    }
}
