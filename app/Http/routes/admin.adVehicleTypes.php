<?php

/**/
/*PROCESOS GET*/
Route::get('admin/vehicle/list/{nav}/{action}',[
    'as'   => 'admin.vehicle.list',
    'uses' => 'Admin\AdVehicleTypesController@index'
]);

Route::get('admin/vehicle/edit/{nav}/{action}/{id}', [
    'as' => 'admin.vehicle.edit',
    'uses' => 'Admin\AdVehicleTypesController@edit'
]);

Route::get('admin/vehicle/new', [
    'as' => 'admin.vehicle.new',
    'uses' => 'Admin\AdVehicleTypesController@create'
]);
Route::get('admin/vehicle/destroy/{id}',[
    'as' => 'admin.vehicle.destroy',
    'uses' => 'Admin\AdVehicleTypesController@destroy'
]);

/*PROCESOS POST*/
Route::post('admin/vehicle/edit', [
    'as' => 'update_vehicle_type',
    'uses' => 'Admin\AdVehicleTypesController@update'
]);

Route::post('admin/vehicle/new', [
    'as' => 'create_vehicle_types',
    'uses' => 'Admin\AdVehicleTypesController@store'
]);