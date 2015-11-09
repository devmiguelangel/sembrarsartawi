<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ActivityTableSeeder::class);
        $this->call(AgencyTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CoverageTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(RetailerUserTableSeeder::class);

        Model::reguard();
    }
}
