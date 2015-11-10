<?php

use Illuminate\Support\Facades\Hash;
use Sibas\Entities\User;

class UserTableSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Support\Facades\DB
     */
    protected function getModel()
    {
        return new User();
    }

    protected function getData()
    {
        $data = [];

        $data[] = [
            'id'        => 1446238228,
            'username'  => 'admin',
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
        ];

        return $data;
    }
}
