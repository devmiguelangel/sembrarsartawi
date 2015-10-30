<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoverageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

        foreach ($coverages as $coverage) {
            DB::table('ad_coverages')->insert([
                'name' => $coverage['name'],
                'slug' => $coverage['slug']
            ]);
        }

    }
}
