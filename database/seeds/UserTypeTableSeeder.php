<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_types = \Config::get('base.user_types');

        foreach ($user_types as $key => $user_type) {
            DB::table('ad_user_types')->insert([
                'name' => $user_type,
                'code' => $key,
                'slug' => Str::slug($user_type),
            ]);
        }


    }
}
