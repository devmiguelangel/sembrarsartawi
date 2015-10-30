<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = [
            'OFICINA CENTRAL(LPZ)',
            'AG.TUMUSLA(LPZ)',
            'AG.HIPERMAXI LOS PINOS(LPZ)',
            'AG. VILLA FATIMA (LPZ)',
        ];

        foreach ($agencies as $agency) {
            DB::table('ad_agencies')->insert([
                'name' => $agency,
                'code' => mt_rand(10, 99),
                'slug' => Str::slug($agency)
            ]);
        }

    }
}
