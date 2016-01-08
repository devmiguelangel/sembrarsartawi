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


/**
 PROCESOS POST
 **/
Route::post('admin/de/addquestion/new', [
    'as' => 'create_add_question',
    'uses' => 'Admin\AddQuestionAdminController@store'
]);


/**
PROCESOS AJAX
 **/
Route::get('admin/de/addquestion/active_ajax/{id_retailer_product_question}/{text}', 'Admin\AddQuestionAdminController@ajax_active_inactive');