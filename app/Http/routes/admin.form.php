<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 22/02/2016
 * Time: 11:55
 */
Route::get('admin/formulario/list-product-retailer/{nav}/{action}', [
    'as' => 'admin.formulario.list-product-retailer',
    'uses' => 'Admin\FormAdminController@index_product_retailer'
]);

Route::get('admin/formulario/list/{nav}/{action}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.formulario.list',
    'uses' => 'Admin\FormAdminController@index'
]);

Route::get('admin/formulario/new/{nav}/{action}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.formulario.new',
    'uses' => 'Admin\FormAdminController@index'
]);

Route::get('admin/formulario/edit/{nav}/{action}/{id_forms}/{id_retailer_products}/{code_product}', [
    'as' => 'admin.formulario.edit',
    'uses' => 'Admin\FormAdminController@edit'
]);

Route::post('admin/formulario/new', [
    'as' => 'new_file_form',
    'uses' => 'Admin\FormAdminController@store'
]);

Route::post('admin/formulario/edit', [
    'as' => 'update_file_form',
    'uses' => 'Admin\FormAdminController@update'
]);

//AJAX
Route::get('admin/formulario/delete_ajax/{id_forms}', 'Admin\FormAdminController@ajax_delete');