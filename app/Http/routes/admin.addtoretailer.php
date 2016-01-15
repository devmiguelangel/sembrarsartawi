<?php
/**
 * PROCESOS GET
 **/
Route::get('admin/addtoretailer/list/{nav}/{action}/{id_company}', [
    'as' => 'admin.addtoretailer.list',
    'uses' => 'Admin\CompanyProductToRetailerAdminController@index'
]);

Route::get('admin/addtoretailer/new/{nav}/{action}/{id_company}', [
    'as' => 'admin.addtoretailer.new',
    'uses' => 'Admin\CompanyProductToRetailerAdminController@index'
]);

/**
 * PROCESOS POST
**/
Route::post('admin/addtoretailer/new', [
    'as' => 'new_addproductretailer',
    'uses' => 'Admin\CompanyProductToRetailerAdminController@store'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/addtoretailer/quest_ajax/{id_company_product}/{id_retailer}', 'Admin\CompanyProductToRetailerAdminController@ajax_quest');
Route::get('admin/addtoretailer/active_ajax/{id_retailer_products}/{text}', 'Admin\CompanyProductToRetailerAdminController@ajax_active_inactive');