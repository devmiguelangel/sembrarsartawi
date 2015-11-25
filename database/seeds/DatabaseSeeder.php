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
            'ad_questions',
            'ad_retailer_product_questions',
            'ad_retailer_subproducts',
            'ad_rates',
            'ad_plans',
            'ad_policies',

            'op_de_headers',
            'op_de_details',
            'op_de_responses',
            'op_clients',

            'ad_plans',
            'op_vi_headers',
            'op_vi_cancellations',
            'op_vi_details',
            'op_accounts',
            'op_vi_beneficiaries',
        ];

        $this->truncateTables($tables);

        $this->call(ActivityTableSeeder::class);
        $this->call(AgencyTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CoverageTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CompanyProductTableSeeder::class);
        $this->call(RetailerTableSeeder::class);
        $this->call(RetailerUserTableSeeder::class);
        $this->call(RetailerProductTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
        $this->call(RetailerProductQuestionTableSeeder::class);
        $this->call(RateTableSeeder::class);
        $this->call(RetailerSubProductTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(PolicyTableSeeder::class);

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
