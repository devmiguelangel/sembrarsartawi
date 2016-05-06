<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 25/04/2016
 * Time: 12:30
 */
Route::get('admin/de/creditproduct/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.creditproduct.list',
    'uses' => 'Admin\CreditProductAdminController@index'
]);

Route::get('admin/de/creditproduct/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.creditproduct.new',
    'uses' => 'Admin\CreditProductAdminController@index'
]);

//PROCESOS POST
Route::post('admin/de/creditproduct/new', [
    'as' => 'create_credit_product',
    'uses' => 'Admin\CreditProductAdminController@store'
]);

//AJAX
Route::get('admin/de/creditproduct/active_ajax/{id_credit_product}/{text}/{id_retailer_product}', 'Admin\CreditProductAdminController@ajax_active_inactive');

