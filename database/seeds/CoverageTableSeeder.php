<?php

use Sibas\Entities\De\Coverage;

class CoverageTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new Coverage();
    }

    protected function getData()
    {
        $coverages = [
            [
                'name' => 'Individual',
                'slug' => 'IC'
            ],
            [
                'name' => 'Mancomunado',
                'slug' => 'MC'
            ],
            [
                'name' => 'Banca Comunal',
                'slug' => 'BC'
            ],
        ];

        $data = [];

        foreach ($coverages as $coverage) {
            $data[] = [
                'name' => $coverage['name'],
                'slug' => $coverage['slug']
            ];
        }

        return $data;
    }
}
