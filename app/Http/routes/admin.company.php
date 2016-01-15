<?php
/**
 * PROCESOS GET
**/
Route::get('admin/company/list/{nav}/{action}',[
    'as'   => 'admin.company.list',
    'uses' => 'Admin\CompanyAdminController@index'
]);

Route::get('admin/company/edit/{nav}/{action}/{id_company}', [
    'as' => 'admin.company.edit',
    'uses' => 'Admin\CompanyAdminController@edit'
]);

Route::get('admin/company/new/{nav}/{action}', [
    'as' => 'admin.company.new',
    'uses' => 'Admin\CompanyAdminController@index'
]);

/**
 * PROCESOS POST
**/
Route::post('admin/company/edit', [
    'as' => 'edit_company',
    'uses' => 'Admin\CompanyAdminController@update'
]);

Route::post('admin/company/new', [
    'as' => 'new_company',
    'uses' => 'Admin\CompanyAdminController@store'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/company/active_ajax/{id_company}/{text}', 'Admin\CompanyAdminController@ajax_active_inactive');