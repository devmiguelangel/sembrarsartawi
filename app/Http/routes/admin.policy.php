<?php
/**
 * PROCESOS GET
 **/
Route::get('admin/policy/list/{nav}/{action}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.policy.list',
    'uses' => 'Admin\PolicyAdminController@index'
]);

Route::get('admin/policy/edit/{nav}/{action}/{id_policies}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.policy.edit',
    'uses' => 'Admin\PolicyAdminController@edit'
]);

Route::get('admin/policy/new/{nav}/{action}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.policy.new',
    'uses' => 'Admin\PolicyAdminController@index'
]);

Route::get('admin/policy/list-product-retailer/{nav}/{action}', [
    'as' => 'admin.policy.list-product-retailer',
    'uses' => 'Admin\PolicyAdminController@index_product_retailer'
]);
/**
 * PROCESOS POST
 **/
Route::post('admin/policy/edit', [
    'as' => 'update_policy',
    'uses' => 'Admin\PolicyAdminController@update'
]);

Route::post('admin/policy/new', [
    'as' => 'create_policy',
    'uses' => 'Admin\PolicyAdminController@store'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/policy/active_ajax/{id_policies}/{text}', 'Admin\PolicyAdminController@ajax_active_inactive');