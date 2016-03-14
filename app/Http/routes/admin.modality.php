<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 10/03/2016
 * Time: 8:32
 */
Route::get('admin/vi/modality/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.modality.list',
    'uses' => 'Admin\ModalityAdminController@index'
]);

Route::get('admin/vi/modality/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.modality.new',
    'uses' => 'Admin\ModalityAdminController@index'
]);

Route::get('admin/vi/modality/edit/{nav}/{action}/{id_retailer_product}/{id_modality}', [
    'as' => 'admin.vi.modality.edit',
    'uses' => 'Admin\ModalityAdminController@edit'
]);


Route::post('admin/vi/modality/new', [
    'as' => 'new_modality',
    'uses' => 'Admin\ModalityAdminController@store'
]);

Route::post('admin/vi/modality/edit', [
    'as' => 'update_modality',
    'uses' => 'Admin\ModalityAdminController@update'
]);


/*PROCESOS AJAX*/
Route::get('admin/vi/modality/modality_ajax/{id_modality}', 'Admin\ModalityAdminController@ajax_modality');
Route::get('admin/vi/modality/active_ajax/{id_modality}/{modality_code}/{text}', 'Admin\ModalityAdminController@ajax_active_inactive');
Route::get('admin/vi/modality/delete_ajax/{id_modality}', 'Admin\ModalityAdminController@ajax_delete');