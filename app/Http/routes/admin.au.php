<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 28/03/2016
 * Time: 16:41
 */
//FUNCIONES GET
Route::get('admin/au/parameters/list-parameter/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.parameters.list-parameter',
    'uses' => 'Admin\AuAdminController@index'
]);

Route::get('admin/au/parameters/edit-parameter/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.parameters.edit-parameter',
    'uses' => 'Admin\AuAdminController@edit'
]);

Route::get('admin/au/parameters/list-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.parameters.list-parameter-additional',
    'uses' => 'Admin\AuAdminController@index_parameter'
]);

Route::get('admin/au/parameters/new-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.parameters.new-parameter-additional',
    'uses' => 'Admin\AuAdminController@index_parameter'
]);

Route::get('admin/au/parameters/edit-parameter-additional/{nav}/{action}/{id_product_parameters}/{id_retailer_product}', [
    'as' => 'admin.au.parameters.edit-parameter-additional',
    'uses' => 'Admin\AuAdminController@edit_parameter_additional'
]);

//FUNCIONES POST
Route::post('admin/au/parameters/edit-parameter', [
    'as' => 'update_au_parameter',
    'uses' => 'Admin\AuAdminController@update'
]);

Route::post('admin/au/parameters/new-parameter-additional', [
    'as' => 'create_au_parameter',
    'uses' => 'Admin\AuAdminController@store'
]);

Route::post('admin/au/parameters/edit-parameter-additional', [
    'as' => 'update_au_parameter_additional',
    'uses' => 'Admin\AuAdminController@update_parameter_additional'
]);

//AJAX
Route::get('admin/au/parameters/delete_ajax/{id_product_parameters}/{ad_retailer_product_id}', 'Admin\AuAdminController@ajax_delete');