<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 05/04/2016
 * Time: 15:31
 */
Route::get('admin/payment/list-product-retailer/{nav}/{action}', [
    'as' => 'admin.payment.list-product-retailer',
    'uses' => 'Admin\PaymentAdminController@index_product_retailer'
]);

Route::get('admin/payment/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.payment.list',
    'uses' => 'Admin\PaymentAdminController@index'
]);

Route::get('admin/payment/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.payment.new',
    'uses' => 'Admin\PaymentAdminController@index'
]);

//PROCESOS POST
Route::post('admin/payment/new', [
    'as' => 'create_payment_method',
    'uses' => 'Admin\PaymentAdminController@store'
]);

//AJAX
Route::get('admin/payment/active_ajax/{id_payment_method}/{text}/{id_retailer_product}', 'Admin\PaymentAdminController@ajax_active_inactive');
Route::get('admin/payment/delete_ajax/{id_payment_method}/{id_retailer_product}', 'Admin\PaymentAdminController@ajax_delete');