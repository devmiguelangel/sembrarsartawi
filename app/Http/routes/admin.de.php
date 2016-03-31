<?php

/**/

Route::get('admin/de/parameters/list-parameter/{nav}/{action}/{id_retailer_product}',[
'as'   => 'admin.de.parameters.list-parameter',
'uses' => 'Admin\DeAdminController@index'
]);

Route::get('admin/de/parameters/edit-parameter/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.parameters.edit-parameter',
    'uses' => 'Admin\DeAdminController@edit'
]);

Route::get('admin/de/parameters/list-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.parameters.list-parameter-additional',
    'uses' => 'Admin\DeAdminController@index_parameter'
]);

Route::get('admin/de/parameters/new-parameter-additional/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.parameters.new-parameter-additional',
    'uses' => 'Admin\DeAdminController@index_parameter'
]);

Route::get('admin/de/parameters/edit-parameter-additional/{nav}/{action}/{id_product_parameters}/{id_retailer_product}', [
    'as' => 'admin.de.parameters.edit-parameter-additional',
    'uses' => 'Admin\DeAdminController@index_parameter_additional'
]);

Route::post('admin/de/parameters/edit-parameter', [
    'as' => 'update_parameter',
    'uses' => 'Admin\DeAdminController@update'
]);

Route::post('admin/de/parameters/new-parameter-additional', [
        'as' => 'create_parameter',
        'uses' => 'Admin\DeAdminController@store'
    ]);

Route::post('admin/de/parameters/edit-parameter-additional', [
    'as' => 'update_parameter_additional',
    'uses' => 'Admin\DeAdminController@update_data'
]);

//AJAX
Route::get('admin/de/parameters/delete_ajax/{id_product_parameters}/{ad_retailer_product_id}', 'Admin\DeAdminController@ajax_delete');