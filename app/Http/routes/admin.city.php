<?php
/** PROCESOS GET **/
Route::get('admin/cities/list/{nav}/{action}', [
    'as' => 'admin.cities.list',
    'uses' => 'Admin\CityAdminController@index'
]);

Route::get('admin/cities/new/{nav}/{action}',[
    'as' => 'admin.cities.new',
    'uses' => 'Admin\CityAdminController@index'
]);

Route::get('admin/cities/edit/{nav}/{action}/{id_depto}', [
    'as' => 'admin.cities.edit',
    'uses' => 'Admin\CityAdminController@edit'
]);

Route::get('admin/cities/list-city-retailer/{nav}/{action}', [
    'as' => 'admin.cities.list-city-retailer',
    'uses' => 'Admin\CityAdminController@index_city_retailer'
]);

Route::get('admin/cities/new-city-retailer/{nav}/{action}', [
    'as' => 'admin.cities.new-city-retailer',
    'uses' => 'Admin\CityAdminController@index_city_retailer'
]);


/** PROCESOS POST **/

Route::post('admin/cities/edit', [
    'as' => 'update_city',
    'uses' => 'Admin\CityAdminController@update'
]);

Route::post('admin/cities/new', [
    'as' => 'create_city',
    'uses' => 'Admin\CityAdminController@store'
]);

Route::post('admin/cities/new-city-retailer', [
    'as' => 'add_city_retailer',
    'uses' => 'Admin\CityAdminController@store_city_retailer'
]);

/** PROCESOS AJAX **/
Route::get('admin/cities/typeci_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typeci');
Route::get('admin/cities/typere_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typere');
Route::get('admin/cities/typede_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typede');
Route::get('admin/cities/retailer_city_ajax/{id_retailer}', 'Admin\CityAdminController@ajax_city_retailer');
Route::get('admin/cities/active_ajax/{id_city_retailer}/{text}', 'Admin\CityAdminController@ajax_active_inactive');