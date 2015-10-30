<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_users')->insert([
            'id'        => date('U'),
            'user_name' => 'admin',
            'password'  => Hash::make('admin123'),
            'full_name' => 'Administrador',
            'email'     => 'admin@coboser.com',
            'position'  => '',
            'phone_number'  => '2123456',
            'signature'     => '',
            'password_change'   => true,
            'password_date'     => date('Y-m-d H:i:s'),
            'attempt'           => 0,
            'ad_city_id'        => null,
            'ad_agency_id'      => null,
            'ad_user_type_id'   => 1,
            'active'            => true
        ]);
    }
}
