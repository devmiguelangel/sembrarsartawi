<?php
/**
 PROCESOS GET
 **/
Route::get('admin/agencies/list/{nav}/{action}', [
    'as' => 'admin.agencies.list',
    'uses' => 'Admin\AgencyAdminController@index'
]);

Route::get('admin/agencies/edit/{nav}/{action}/{id_agency}', [
    'as' => 'admin.agencies.edit',
    'uses' => 'Admin\AgencyAdminController@edit'
]);

Route::get('admin/agencies/new/{nav}/{action}', [
    'as' => 'admin.agencies.new',
    'uses' => 'Admin\AgencyAdminController@index'
]);

Route::get('admin/agencies/list_retailer/{nav}/{action}/{id_agency}', [
    'as' => 'admin.agencies.list_retailer',
    'uses' => 'Admin\AgencyAdminController@list_retailer'
]);

Route::get('admin/agencies/list-agency-retailer/{nav}/{action}', [
    'as' => 'admin.agencies.list-agency-retailer',
    'uses' => 'Admin\AgencyAdminController@index_agency_retailer'
]);

Route::get('admin/agencies/new-agency-retailer/{nav}/{action}', [
    'as' => 'admin.agencies.new-agency-retailer',
    'uses' => 'Admin\AgencyAdminController@index_agency_retailer'
]);

Route::get('active_inactive_agency/{id_retailer_city_agency}/{text}', [
    'as' => 'active_inactive_agency',
    'uses' => 'Admin\AgencyAdminController@ajax_active_inactive'
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

Route::post('admin/agencies/new-agency-retailer', [
    'as' => 'add_agency_retailer',
    'uses' => 'Admin\AgencyAdminController@store_agency_city'
]);

/** PROCESOS AJAX **/
Route::get('admin/agencies/cities_ajax/{id_retailer}', 'Admin\AgencyAdminController@ajax_cities');
Route::get('admin/agencies/retailer_agencies_ajax/{id_retailer_city}', 'Admin\AgencyAdminController@ajax_agencies_retailer');
/*Route::get('admin/cities/active_ajax/{id_retailer_city_agency}/{text}', 'Admin\AgencyAdminController@ajax_active_inactive');*/