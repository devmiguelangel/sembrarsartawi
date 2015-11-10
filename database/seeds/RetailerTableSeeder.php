<?php

use Illuminate\Support\Str;
use Sibas\Entities\Retailer;

class RetailerTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new Retailer();
    }

    protected function getData()
    {
        $data = [];

        $name = 'Sembrar Sartawi IFD';

        $data[] = [
            'name'      => $name,
            'image'     => 'image.jpg',
            'domain'    => 'sembrarsartawi',
            'about_us'  => '',
            'slug'      => Str::slug($name),
            'active'    => true
        ];

        return $data;
    }
}
