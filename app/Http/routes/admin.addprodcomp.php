<?php
/**
 * PROCESOS GET
 **/
Route::get('admin/addproductcompany/list/{nav}/{action}/{id_company}', [
    'as' => 'admin.addproductcompany.list',
    'uses' => 'Admin\AddProductCompanyAdminController@index'
]);

Route::get('admin/addproductcompany/new/{nav}/{action}/{id_company}', [
    'as' => 'admin.addproductcompany.new',
    'uses' => 'Admin\AddProductCompanyAdminController@index'
]);

/**
 * PROCESOS POST
 **/
Route::post('admin/addproductcompany/new', [
    'as' => 'new_addproduct',
    'uses' => 'Admin\AddProductCompanyAdminController@store'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/addproductcompany/active_ajax/{id_company_product}/{text}', 'Admin\AddProductCompanyAdminController@ajax_active_inactive');
