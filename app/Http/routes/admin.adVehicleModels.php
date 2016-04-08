<?php

/**/
/*PROCESOS GET*/
Route::get('admin/vehicle_models/list/{nav}/{action}/{id_make}',[
    'as'   => 'admin.vehicle_models.list',
    'uses' => 'Admin\AdVehicleModelsController@index'
]);

Route::get('admin/vehicle_models/edit/{nav}/{action}/{id}', [
    'as' => 'admin.vehicle_models.edit',
    'uses' => 'Admin\AdVehicleModelsController@edit'
]);

Route::get('admin/vehicle_models/new/{id_make}', [
    'as' => 'admin.vehicle_models.new',
    'uses' => 'Admin\AdVehicleModelsController@create'
]);
Route::get('admin/vehicle_models/destroy/{id}/{id_make}',[
    'as' => 'admin.vehicle_models.destroy',
    'uses' => 'Admin\AdVehicleModelsController@destroy'
]);

/*PROCESOS POST*/
Route::post('admin/vehicle_models/edit', [
    'as' => 'update_vehicle_models',
    'uses' => 'Admin\AdVehicleModelsController@update'
]);

Route::post('admin/vehicle_models/new', [
    'as' => 'create_vehicle_models',
    'uses' => 'Admin\AdVehicleModelsController@store'
]);