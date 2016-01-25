<?php
/**
 * PROCESOS GET
 **/

Route::get('admin/vi/parameters/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.list',
    'uses' => 'Admin\ViAdminController@index'
]);

Route::get('admin/vi/parameters/list-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.list-parameter-additional',
    'uses' => 'Admin\ViAdminController@index'
]);

Route::get('admin/vi/parameters/edit/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.edit',
    'uses' => 'Admin\ViAdminController@edit'
]);

Route::get('admin/vi/parameters/new-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.new-parameter-additional',
    'uses' => 'Admin\ViAdminController@index'
]);

Route::get('admin/vi/parameters/edit-parameter-additional/{nav}/{action}/{id_product_parameters}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.edit-parameter-additional',
    'uses' => 'Admin\ViAdminController@edit_parameter_additional'
]);


/**
 *PROCESOS POST
 **/
Route::post('admin/vi/parameters/edit', [
    'as' => 'update_parameter',
    'uses' => 'Admin\ViAdminController@update'
]);

Route::post('admin/vi/parameters/new-parameter-additional', [
    'as' => 'create_parameter',
    'uses' => 'Admin\ViAdminController@store'
]);

