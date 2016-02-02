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

Route::get('admin/vi/parameters/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.parameters.new',
    'uses' => 'Admin\ViAdminController@index'
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
    'as' => 'update_parameter_vi',
    'uses' => 'Admin\ViAdminController@update'
]);

Route::post('admin/vi/parameters/new-parameter-additional', [
    'as' => 'create_parameter_aditional_vi',
    'uses' => 'Admin\ViAdminController@store'
]);

Route::post('admin/vi/parameters/edit-parameter-additional', [
    'as' => 'update_parameter_aditional_vi',
    'uses' => 'Admin\ViAdminController@update_parameter_additional'
]);

Route::post('admin/vi/parameters/new', [
    'as' => 'new_parameter_vi',
    'uses' => 'Admin\ViAdminController@store_parameter'
]);

