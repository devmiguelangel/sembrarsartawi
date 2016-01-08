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
