<?php
/**
 PROCESOS GET
 **/
Route::get('admin/agencies/list/{nav}/{action}/{id_retailer}', [
    'as' => 'admin.agencies.list',
    'uses' => 'Admin\AgencyAdminController@index'
]);

Route::get('admin/agencies/edit/{nav}/{action}/{id_agency}/{id_retailer}', [
    'as' => 'admin.agencies.edit',
    'uses' => 'Admin\AgencyAdminController@edit'
]);

Route::get('admin/agencies/new/{nav}/{action}/{id_retailer}', [
    'as' => 'admin.agencies.new',
    'uses' => 'Admin\AgencyAdminController@index'
]);

/**
PROCESOS POST
 **/
Route::post('admin/agencies/edit', [
    'as' => 'update_agency',
    'uses' => 'Admin\AgencyAdminController@update'
]);

Route::post('admin/agencies/new', [
    'as' => 'create_agency',
    'uses' => 'Admin\AgencyAdminController@store'
]);