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

/** PROCESOS POST **/

Route::post('admin/cities/edit', [
    'as' => 'update_city',
    'uses' => 'Admin\CityAdminController@update'
]);

Route::post('admin/cities/new', [
    'as' => 'create_city',
    'uses' => 'Admin\CityAdminController@store'
]);



/** PROCESOS AJAX **/
Route::get('admin/cities/typeci_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typeci');
Route::get('admin/cities/typere_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typere');
Route::get('admin/cities/typede_ajax/{id_depto}/{answer}', 'Admin\CityAdminController@ajax_typede');