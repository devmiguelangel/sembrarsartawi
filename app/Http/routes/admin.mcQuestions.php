<?php
/* questions preguntas certificado medico */

Route::get('admin/mc_questions/list',[
    'as' => 'mcQuestionsList',
    'uses' => 'Admin\McQuestionsController@index'
]);
Route::get('admin/mc_questions/form_new',[
    'as' => 'mcQuestionsFormNew',
    'uses' => 'Admin\McQuestionsController@create'
]);
Route::get('admin/mc_questions/form_edit/{id}',[
    'as' => 'mcQuestionsFormEdit',
    'uses' => 'Admin\McQuestionsController@edit'
]);
Route::get('admin/mc_questions/destroy/{id}',[
    'as' => 'mcQuestionsFormDestroy',
    'uses' => 'Admin\McQuestionsController@destroy'
]);
# registro y edicion
Route::post('admin/mc_questions/new', [
    'as' => 'create_mc_questions',
    'uses' => 'Admin\McQuestionsController@store'
]);
Route::post('admin/mc_questions/edit/{id}', [
    'as' => 'update_mc_questions',
    'uses' => 'Admin\McQuestionsController@update'
]);