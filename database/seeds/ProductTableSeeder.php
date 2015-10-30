<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_id = DB::table('ad_products')->insertGetId([
            'type' => 'PH',
            'name' => 'Desgravamen',
            'code' => 'de',
            'slug' => Str::slug('Desgravamen')
        ]);

        $name = 'Alianza Grupo Asegurador';

        $company_id = DB::table('ad_companies')->insertGetId([
            'name'    => $name,
            'image'   => 'image.jpg',
            'slug'    => Str::slug($name),
            'active'  => true
        ]);

        $company_product_id = DB::table('ad_company_products')->insertGetId([
            'ad_company_id' => $company_id,
            'ad_product_id' => $product_id,
            'active'        => true
        ]);

        $name = 'Sembrar Sartawi IFD';

        $retailer_id = DB::table('ad_retailers')->insertGetId([
            'name'      => $name,
            'image'     => 'image.jpg',
            'domain'    => 'sembrarsartawi',
            'about_us'  => '',
            'slug'      => Str::slug($name),
            'active'    => true
        ]);

        DB::table('ad_retailer_products')->insert([
            'id' => date('U'),
            'ad_retailer_id'        => $retailer_id,
            'ad_company_product_id' => $company_product_id,
            'type'      => 'MP',
            'billing'   => false,
            'provisional_certificate' => false,
            'modality'    => false,
            'facultative' => false,
            'ws'          => false,
            'landing'     => '',
            'questions'   => '',
            'active'      => true
        ]);

    }
}
