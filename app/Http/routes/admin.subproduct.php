<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 03/02/2016
 * Time: 17:07
 */
Route::get('admin/subproduct/list/{nav}/{action}/{id_retailer_product_select}', [
    'as' => 'admin.subproduct.list',
    'uses' => 'Admin\SubProductAdminController@index'
]);

Route::post('admin/subproduct/list', [
    'as' => 'add_subproduct',
    'uses' => 'Admin\SubProductAdminController@store'
]);

Route::get('admin/subproduct/subprod_ajax/{id_retailer_product}', 'Admin\SubProductAdminController@ajax_subproduct');