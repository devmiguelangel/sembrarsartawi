<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = 'AGRICULTURA Y GANADERIA';
        $activities = [
            0 => 'A-CULTIVO DE CEREALES',
            1 => 'A-CULTIVO DE OLEAGINOSAS',
            2 => 'A-CULTIVO DE PLANTAS PARA LA OBTENCION DE FIBRAS',
            3 => 'A-CULTIVO DE FLORES Y PLANTAS ORNAMENTALES',
        ];

        foreach ($activities as $activity) {
            DB::table('ad_activities')->insert([
                'category'   => $category,
                'occupation' => $activity,
                'code'       => mt_rand(1000, 9999)
            ]);
        }
    }
}
