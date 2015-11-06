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
            0 => 'A-CULTIVO De CEREALES',
            1 => 'A-CULTIVO De OLEAGINOSAS',
            2 => 'A-CULTIVO De PLANTAS PARA LA OBTENCION De FIBRAS',
            3 => 'A-CULTIVO De FLORES Y PLANTAS ORNAMENTALES',
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
