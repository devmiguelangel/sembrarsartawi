<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 10/02/2016
 * Time: 11:03
 */
Route::get('admin/cobertura/list/{nav}/{action}', [
    'as' => 'admin.cobertura.list',
    'uses' => 'Admin\CoverageAdminController@index'
]);

Route::get('admin/cobertura/new/{nav}/{action}', [
    'as' => 'admin.cobertura.new',
    'uses' => 'Admin\CoverageAdminController@index'
]);

Route::get('admin/cobertura/edit/{nav}/{action}/{id_retailer_product_coverage}', [
    'as' => 'admin.cobertura.edit',
    'uses' => 'Admin\CoverageAdminController@edit'
]);

Route::post('admin/cobertura/new', [
    'as' => 'new_coverage',
    'uses' => 'Admin\CoverageAdminController@store'
]);

Route::post('admin/cobertura/edit', [
    'as' => 'update_coverage',
    'uses' => 'Admin\CoverageAdminController@update'
]);

/**
 * PROCESOS AJAX
 * */
Route::get('admin/cobertura/product_retailer_ajax/{id_retailer}', 'Admin\CoverageAdminController@ajax_product_retailer');
Route::get('admin/cobertura/active_ajax/{id_retailer_product_coverage}/{text}', 'Admin\CoverageAdminController@ajax_active_inactive');