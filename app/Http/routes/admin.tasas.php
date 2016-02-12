<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 11/02/2016
 * Time: 12:08
 */
Route::get('admin/tasas/list/{nav}/{action}', [
    'as' => 'admin.tasas.list',
    'uses' => 'Admin\TasasAdminController@index'
]);

Route::get('admin/tasas/new/{nav}/{action}', [
    'as' => 'admin.tasas.new',
    'uses' => 'Admin\TasasAdminController@index'
]);

Route::get('admin/tasas/edit/{nav}/{action}/{id_rates}', [
    'as' => 'admin.tasas.edit',
    'uses' => 'Admin\TasasAdminController@edit'
]);


Route::post('admin/tasas/new', [
    'as' => 'new_rates',
    'uses' => 'Admin\TasasAdminController@store'
]);

Route::post('admin/tasas/edit', [
    'as' => 'update_rates',
    'uses' => 'Admin\TasasAdminController@update'
]);

/**
 * AJAX
**/
Route::get('admin/tasas/product_retailer_ajax/{id_retailer}', 'Admin\TasasAdminController@ajax_product_retailer');
Route::get('admin/tasas/cobertura_ajax/{id_retailer_product}', 'Admin\TasasAdminController@ajax_cobertura');