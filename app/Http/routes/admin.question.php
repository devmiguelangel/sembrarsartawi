<?php

/**/
/*PROCESOS GET*/
Route::get('admin/questions/list/{nav}/{action}',[
    'as'   => 'admin.questions.list',
    'uses' => 'Admin\QuestionAdminController@index'
]);

Route::get('admin/questions/edit/{nav}/{action}/{id_question}', [
    'as' => 'admin.questions.edit',
    'uses' => 'Admin\QuestionAdminController@edit'
]);

Route::get('admin/questions/new/{nav}/{action}', [
    'as' => 'admin.questions.new',
    'uses' => 'Admin\QuestionAdminController@index'
]);


/*PROCESOS POST*/
Route::post('admin/questions/edit', [
    'as' => 'update_question',
    'uses' => 'Admin\QuestionAdminController@update'
]);

Route::post('admin/questions/new', [
    'as' => 'create_question',
    'uses' => 'Admin\QuestionAdminController@store'
]);