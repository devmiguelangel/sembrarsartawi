<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 09/05/2016
 * Time: 12:05
 */
Route::get('admin/td/parameters/list-parameter/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.parameters.list-parameter',
    'uses' => 'Admin\MrAdminController@index'
]);

Route::get('admin/td/parameters/edit-parameter/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.parameters.edit-parameter',
    'uses' => 'Admin\MrAdminController@edit'
]);

Route::get('admin/td/parameters/list-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.parameters.list-parameter-additional',
    'uses' => 'Admin\MrAdminController@index_parameter'
]);

Route::get('admin/td/parameters/new-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.parameters.new-parameter-additional',
    'uses' => 'Admin\MrAdminController@index_parameter'
]);

Route::get('admin/td/parameters/edit-parameter-additional/{nav}/{action}/{id_product_parameters}/{id_retailer_product}', [
    'as' => 'admin.td.parameters.edit-parameter-additional',
    'uses' => 'Admin\MrAdminController@edit_parameter_additional'
]);

/*PROCESOS POST*/
Route::post('admin/td/parameters/edit-parameter', [
    'as' => 'update_mr_parameter',
    'uses' => 'Admin\MrAdminController@update'
]);

Route::post('admin/td/parameters/new-parameter-additional', [
    'as' => 'create_mr_parameter',
    'uses' => 'Admin\MrAdminController@store'
]);

Route::post('admin/td/parameters/edit-parameter-additional', [
    'as' => 'update_mr_parameter_additional',
    'uses' => 'Admin\MrAdminController@update_parameter_additional'
]);


