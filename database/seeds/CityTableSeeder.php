<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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


        foreach ($cities as $data) {
            DB::table('ad_cities')->insert([
                'name'          => $data['city'],
                'abbreviation'  => $data['abbreviation'],
                'type'          => $data['type'],
                'slug'          => Str::slug($data['city'])
            ]);
        }
    }
}
