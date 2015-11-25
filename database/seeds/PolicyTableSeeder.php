<?php

use Sibas\Entities\Policy;

class PolicyTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new Policy();
    }

    protected function getData()
    {
        
    }
}
