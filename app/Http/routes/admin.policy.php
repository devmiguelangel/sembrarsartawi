<?php
/**
 * PROCESOS GET
 **/
Route::get('admin/policy/list/{nav}/{action}/{id_retailer_products}/{id_company}/{code_product}', [
    'as' => 'admin.policy.list',
    'uses' => 'Admin\PolicyAdminController@index'
]);

Route::get('admin/policy/edit/{nav}/{action}/{id_policies}/{id_company}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.policy.edit',
    'uses' => 'Admin\PolicyAdminController@edit'
]);

Route::get('admin/policy/new/{nav}/{action}/{id_retailer_products}/{id_company}/{code_product}', [
    'as' => 'admin.policy.new',
    'uses' => 'Admin\PolicyAdminController@index'
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