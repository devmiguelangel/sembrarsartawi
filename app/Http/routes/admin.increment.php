<?php
Route::get('admin/au/increment/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.increment.list',
    'uses' => 'Admin\IncrementAdminController@index'
]);

Route::get('admin/au/increment/edit/{nav}/{action}/{id_retailer_product_categories}', [
    'as' => 'admin.au.increment.edit',
    'uses' => 'Admin\IncrementAdminController@edit'
]);

Route::get('admin/au/increment/new/{nav}/{action}/{id_retailer_products}', [
    'as'=> 'admin.au.increment.new',
    'uses' => 'Admin\IncrementAdminController@index'
]);

Route::post('admin/au/increment/new', [
    'as' => 'create_category',
    'uses' => 'Admin\IncrementAdminController@store'
]);

//PROCESOS AJAX
Route::get('admin/au/increment/active_ajax/{id_increment}/{text}/{id_retailer_product}', 'Admin\IncrementAdminController@ajax_active_inactive');