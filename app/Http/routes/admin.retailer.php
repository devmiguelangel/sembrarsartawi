<?php
/**
 PROCESOS GET
 **/
Route::get('admin/retailer/list/{nav}/{action}', [
    'as' => 'admin.retailer.list',
    'uses' => 'Admin\RetailerAdminController@index'
]);

Route::get('admin/retailer/new/{nav}/{action}', [
    'as' => 'admin.retailer.new',
    'uses' => 'Admin\RetailerAdminController@index'
]);

Route::get('admin/retailer/new/{nav}/{action}/{id_retailer}', [
    'as' => 'admin.retailer.edit',
    'uses' => 'Admin\RetailerAdminController@edit'
]);

/**
PROCESOS POST
 **/
Route::post('admin/retailer/edit', [
    'as' => 'edit_retailer',
    'uses' => 'Admin\RetailerAdminController@update'
]);

Route::post('admin/retailer/new', [
    'as' => 'new_retailer',
    'uses' => 'Admin\RetailerAdminController@store'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/retailer/active_ajax/{id_retailer}/{text}', 'Admin\RetailerAdminController@ajax_active_inactive');
