<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 21/01/2016
 * Time: 16:13
 * PROCESOS GET
 */

Route::get('admin/email/list-email-product-retailer/{nav}/{action}', [
    'as' => 'admin.email.list-email-product-retailer',
    'uses' => 'Admin\EmailAdminController@index'
]);

Route::get('admin/email/new-add-email/{nav}/{action}', [
    'as' => 'admin.email.new-add-email',
    'uses' => 'Admin\EmailAdminController@index'
]);

Route::get('admin/email/new-email/{nav}/{action}', [
    'as' => 'admin.email.new-email',
    'uses' => 'Admin\EmailAdminController@index'
]);

Route::get('admin/email/edit-email/{nav}/{action}/{ad_email_id}', [
    'as' => 'admin.email.edit-email',
    'uses' => 'Admin\EmailAdminController@edit'
]);

/**
 * PROCESOS POST
**/
Route::post('admin/email/new-add-email', [
    'as' => 'new_add_email',
    'uses' => 'Admin\EmailAdminController@store'
]);

Route::post('admin/email/new-email', [
    'as' => 'create_new_email',
    'uses' => 'Admin\EmailAdminController@store_new_email'
]);

Route::post('admin/email/edit-email', [
    'as' => 'update_email',
    'uses' => 'Admin\EmailAdminController@update'
]);

/**
 * PROCESOS AJAX
**/
Route::get('admin/email/active_ajax/{id_retailer_product_email}/{text}', 'Admin\EmailAdminController@ajax_active_inactive');
Route::get('admin/email/quest_ajax/{id_email}/{id_product_retailer}', 'Admin\EmailAdminController@ajax_quest_data');
Route::get('admin/email/quest_email/{email}', 'Admin\EmailAdminController@ajax_quest_email');
Route::get('admin/email/email_retailer_product_ajax/{id_product_retailer}', 'Admin\EmailAdminController@ajax_email_retailer_product');