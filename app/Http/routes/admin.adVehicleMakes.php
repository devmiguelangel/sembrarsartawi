<?php

/**/
/*PROCESOS GET*/
Route::get('admin/vehicle_makes/list/{nav}/{action}',[
    'as'   => 'admin.vehicle_makes.list',
    'uses' => 'Admin\AdVehicleMakesController@index'
]);

Route::get('admin/vehicle_makes/edit/{nav}/{action}/{id}', [
    'as' => 'admin.vehicle_makes.edit',
    'uses' => 'Admin\AdVehicleMakesController@edit'
]);

Route::get('admin/vehicle_makes/new', [
    'as' => 'admin.vehicle_makes.new',
    'uses' => 'Admin\AdVehicleMakesController@create'
]);
Route::get('admin/vehicle_makes/destroy/{id}',[
    'as' => 'admin.vehicle_makes.destroy',
    'uses' => 'Admin\AdVehicleMakesController@destroy'
]);

/*PROCESOS POST*/
Route::post('admin/vehicle_makes/edit', [
    'as' => 'update_vehicle_makes',
    'uses' => 'Admin\AdVehicleMakesController@update'
]);

Route::post('admin/vehicle_makes/new', [
    'as' => 'create_vehicle_makes',
    'uses' => 'Admin\AdVehicleMakesController@store'
]);