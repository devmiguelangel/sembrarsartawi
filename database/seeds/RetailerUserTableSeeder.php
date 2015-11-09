<?php

use Illuminate\Database\Seeder;

class RetailerUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_retailer_users')->insert([
            'ad_retailer_id' => 1,
            'ad_user_id'     => 1446238228,
            'active'         => true
        ]);
    }
}
