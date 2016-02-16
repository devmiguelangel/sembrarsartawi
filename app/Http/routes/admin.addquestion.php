<?php
/**
 PROCESOS GET
 **/

Route::get('admin/de/addquestion/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.addquestion.list',
    'uses' => 'Admin\AddQuestionAdminController@index'
]);

Route::get('admin/de/addquestion/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.addquestion.new',
    'uses' => 'Admin\AddQuestionAdminController@index'
]);

Route::get('admin/de/addquestion/edit/{nav}/{action}/{id_retailer_product_question}/{id_retailer_product}', [
    'as' => 'admin.de.addquestion.edit',
    'uses' => 'Admin\AddQuestionAdminController@edit'
]);

Route::get('admin/vi/addquestion/list/{nav}/{action}/{id_retailer_product}',[
    'as' => 'admin.vi.addquestion.list',
    'uses' => 'Admin\AddQuestionAdminController@index_vi'
]);

Route::get('admin/vi/addquestion/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.addquestion.new',
    'uses' => 'Admin\AddQuestionAdminController@index_vi'
]);

Route::get('admin/vi/addquestion/edit/{nav}/{action}/{id_retailer_product_question}/{id_retailer_product}', [
    'as' => 'admin.vi.addquestion.edit',
    'uses' => 'Admin\AddQuestionAdminController@edit_vi'
]);

/**
 PROCESOS POST
 **/
Route::post('admin/de/addquestion/new', [
    'as' => 'create_add_question',
    'uses' => 'Admin\AddQuestionAdminController@store'
]);

Route::post('admin/de/addquestion/edit', [
    'as' => 'update_add_question',
    'uses' => 'Admin\AddQuestionAdminController@update'
]);

Route::post('admin/vi/addquestion/new', [
    'as' => 'new_add_question_vi',
    'uses' => 'Admin\AddQuestionAdminController@store_vi'
]);

Route::post('admin/vi/addquestion/edit', [
    'as' => 'update_add_question_vi',
    'uses' => 'Admin\AddQuestionAdminController@update_vi'
]);

/**
PROCESOS AJAX
 **/
Route::get('admin/de/addquestion/active_ajax/{id_retailer_product_question}/{text}', 'Admin\AddQuestionAdminController@ajax_active_inactive');
Route::get('admin/vi/addquestion/active_ajax_vi/{id_retailer_product_question}/{text}', 'Admin\AddQuestionAdminController@ajax_active_inactive');