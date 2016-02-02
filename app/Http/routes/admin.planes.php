<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 28/01/2016
 * Time: 17:02
 * PROCESOS GET
 */
Route::get('admin/vi/planes/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.planes.list',
    'uses' => 'Admin\PlanesAdminController@index'
]);

Route::get('admin/vi/planes/edit/{nav}/{action}/{id_retailer_product}/{id_planes}', [
    'as' => 'admin.vi.planes.edit',
    'uses' => 'Admin\PlanesAdminController@edit'
]);

Route::get('admin/vi/planes/new/{nav}/{action}/{id_retailer_product}', [
    'as'=> 'admin.vi.planes.new',
    'uses' => 'Admin\PlanesAdminController@index'
]);


/**
 * PROCESOS POST
**/
Route::post('admin/vi/planes/edit', [
    'as' => 'update_plans_vi',
    'uses' => 'Admin\PlanesAdminController@update'
]);

Route::post('admin/vi/planes/new', [
    'as' => 'create_plans_vi',
    'uses' => 'Admin\PlanesAdminController@store'
]);