<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 12/02/2016
 * Time: 17:30
 */
Route::get('admin/estados/list/{nav}/{action}', [
    'as' => 'admin.estados.list',
    'uses' => 'Admin\StateAdminController@index'
]);

Route::get('admin/estados/new/{nav}/{action}', [
    'as' => 'admin.estados.new',
    'uses' => 'Admin\StateAdminController@index'
]);

Route::post('admin/estados/new', [
    'as' => 'new_states',
    'uses' => 'Admin\StateAdminController@store'
]);

/**
 * AJAX
 **/
Route::get('admin/estados/product_retailer_ajax/{id_retailer}', 'Admin\StateAdminController@ajax_product_retailer');
Route::get('admin/estados/retailer_state_ajax/{id_product_retailer}', 'Admin\StateAdminController@ajax_state_retailer');
Route::get('admin/estados/states_ajax/{id_product_retailer}', 'Admin\StateAdminController@ajax_states');
Route::get('admin/estados/active_ajax/{id_retailer_product_states}/{text}', 'Admin\StateAdminController@ajax_active_inactive');
