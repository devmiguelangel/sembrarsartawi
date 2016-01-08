<?php
/**
 PROCESOS GET
 **/
Route::get('admin/product/list/{nav}/{action}', [
    'as' => 'admin.product.list',
    'uses' => 'Admin\ProductAdminController@index'
]);

Route::get('admin/product/new/{nav}/{action}', [
    'as' => 'admin.product.new',
    'uses' => 'Admin\ProductAdminController@index'
]);

Route::get('admin/product/edit/{nav}/{action}/{id_product}', [
    'as' => 'admin.product.edit',
    'uses' => 'Admin\ProductAdminController@edit'
]);