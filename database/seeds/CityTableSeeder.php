<?php

use Illuminate\Support\Str;
use Sibas\Entities\City;

class CityTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new City();
    }

    protected function getData()
    {
        $cities = [
            [
                'city' => 'La Paz',
                'abbreviation' => 'LP',
                'type' => 5
            ],
            [
                'city' => 'Oruro',
                'abbreviation' => 'OR',
                'type' => 5
            ],
            [
                'city' => 'Potosi',
                'abbreviation' => 'PO',
                'type' => 5
            ],
            [
                'city' => 'Cochabamba',
                'abbreviation' => 'CB',
                'type' => 5
            ],
            [
                'city' => 'Chuquisaca',
                'abbreviation' => 'CH',
                'type' => 5
            ],
            [
                'city' => 'Tarija',
                'abbreviation' => 'TJ',
                'type' => 5
            ],
            [
                'city' => 'Santa Cruz',
                'abbreviation' => 'SC',
                'type' => 5
            ],
            [
                'city' => 'Beni',
                'abbreviation' => 'BE',
                'type' => 5
            ],
            [
                'city' => 'Pando',
                'abbreviation' => 'PA',
                'type' => 5
            ],
            [
                'city' => 'El Alto',
                'abbreviation' => '',
                'type' => 3
            ],
            [
                'city' => 'Persona Extranjera',
                'abbreviation' => 'PE',
                'type' => 1
            ],
        ];

        $data = [];

        foreach ($cities as $city) {
            $data[] = [
                'name'          => $city['city'],
                'abbreviation'  => $city['abbreviation'],
                'type'          => $city['type'],
                'slug'          => Str::slug($city['city'])
            ];
        }

        return $data;
    }
}
