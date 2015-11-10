<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        $tables = [
            'ad_activities',
            'ad_agencies',
            'ad_cities',
            'ad_user_types',
            'ad_users',
            'ad_coverages',
            'ad_products',
            'ad_companies',
            'ad_company_products',
            'ad_retailers',
            'ad_retailer_products',
            'ad_retailer_users',
        ];

        $this->truncateTables($tables);

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

    private function truncateTables(array $tables)
    {
        $this->checkForeignKeys(false);

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->checkForeignKeys(true);
    }

    private function checkForeignKeys($check)
    {
        $check = $check ? 1 : 0;

        DB::statement('SET foreign_key_checks = ' . $check . ';');
    }
}
