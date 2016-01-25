<?php
/* activities */

Route::get('admin/mc_questionnaries/list',[
    'as' => 'mcQuestionnariesList',
    'uses' => 'Admin\McQuestionnairesController@index'
]);
Route::get('admin/mc_questionnaries/form_new',[
    'as' => 'mcQuestionnariesFormNew',
    'uses' => 'Admin\McQuestionnairesController@create'
]);
Route::get('admin/mc_questionnaries/form_edit/{id}',[
    'as' => 'mcQuestionnariesFormEdit',
    'uses' => 'Admin\McQuestionnairesController@edit'
]);
Route::get('admin/mc_questionnaries/destroy/{id}',[
    'as' => 'mcQuestionnariesFormDestroy',
    'uses' => 'Admin\McQuestionnairesController@destroy'
]);
# registro y edicion
Route::post('admin/mc_questionnaries/new', [
    'as' => 'create_mc_questionnaries',
    'uses' => 'Admin\McQuestionnairesController@store'
]);
Route::post('admin/mc_questionnaries/edit/{id}', [
    'as' => 'update_mc_questionnaries',
    'uses' => 'Admin\McQuestionnairesController@update'
]);