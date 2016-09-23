<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 11/02/2016
 * Time: 12:08
 */
Route::get('admin/tasas/list-product-retailer/{nav}/{action}', [
    'as' => 'admin.tasas.list-product-retailer',
    'uses' => 'Admin\TasasAdminController@index_product_retailer'
]);

Route::get('admin/tasas/list/{nav}/{action}/{id_retailer_products}/{code_product}/{type}/{type_product}', [
    'as' => 'admin.tasas.list',
    'uses' => 'Admin\TasasAdminController@index'
]);

Route::get('admin/tasas/new/{nav}/{action}/{id_retailer_products}/{code_product}/{type}/{type_product}', [
    'as' => 'admin.tasas.new',
    'uses' => 'Admin\TasasAdminController@index'
]);

Route::get('admin/tasas/edit/{nav}/{action}/{id_rates}/{id_retailer_products}/{code_product}/{type}/{type_product}', [
    'as' => 'admin.tasas.edit',
    'uses' => 'Admin\TasasAdminController@edit'
]);

Route::get('admin/tasas/edit-mortgage/{nav}/{action}/{id_rates}/{id_retailer_products}/{code_product}/{type}', [
    'as' => 'admin.tasas.edit-mortgage',
    'uses' => 'Admin\TasasAdminController@edit_mortgage'
]);

Route::get('admin/tasas/new-mortgage/{nav}/{action}/{id_retailer_products}/{code_product}/{type}/{type_product}', [
    'as' => 'admin.tasas.new-mortgage',
    'uses' => 'Admin\TasasAdminController@new_mortgage'
]);

Route::post('admin/tasas/new', [
    'as' => 'new_rates',
    'uses' => 'Admin\TasasAdminController@store'
]);

Route::post('admin/tasas/new-mortgage', [
    'as' => 'create_rates_mortgage',
    'uses' => 'Admin\TasasAdminController@store_mortgage'
]);

Route::post('admin/tasas/edit', [
    'as' => 'update_rates',
    'uses' => 'Admin\TasasAdminController@update'
]);

/**
 * AJAX
**/
Route::get('admin/tasas/product_retailer_ajax/{id_retailer}/{id_retailer_product}', 'Admin\TasasAdminController@ajax_product_retailer');
Route::get('admin/tasas/cobertura_ajax/{id_retailer_product}', 'Admin\TasasAdminController@ajax_cobertura');
Route::get('admin/tasas/delete_ajax/{id_rates}/{code_product}', 'Admin\TasasAdminController@ajax_delete');
Route::get('admin/tasas/quest_rate_ajax/{id_retailer_product}', 'Admin\TasasAdminController@ajax_quest_rate');