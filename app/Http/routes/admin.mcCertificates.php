<?php
/* certificates certificado medico */

Route::get('admin/mc_certificates/list',[
    'as' => 'mcCertificatesList',
    'uses' => 'Admin\McCertificatesController@index'
]);
Route::get('admin/mc_certificates/form_new',[
    'as' => 'mcCertificatesFormNew',
    'uses' => 'Admin\McCertificatesController@create'
]);
Route::get('admin/mc_certificates/form_edit/{id}',[
    'as' => 'mcCertificatesFormEdit',
    'uses' => 'Admin\McCertificatesController@edit'
]);
Route::get('admin/mc_certificates/destroy/{id}',[
    'as' => 'mcCertificatesFormDestroy',
    'uses' => 'Admin\McCertificatesController@destroy'
]);

# registro y edicion
Route::post('admin/mc_certificates/new', [
    'as' => 'create_mc_certificates',
    'uses' => 'Admin\McCertificatesController@store'
]);
Route::post('admin/mc_certificates/edit/{id}', [
    'as' => 'update_mc_certificates',
    'uses' => 'Admin\McCertificatesController@update'
]);

/* asignacion de questionarios */
Route::get('admin/mc_certificates/mc_questionnaries/new/{id}',[
    'as' => 'mcCertificatesMcCuestionariesForm',
    'uses' => 'Admin\McCertificatesController@asignQuestionnariesForm'
]);
Route::get('admin/mc_certificates/mc_questionnaries/edit/{id}',[
    'as' => 'mcCertificatesMcCuestionariesFormEdit',
    'uses' => 'Admin\McCertificatesController@asignQuestionnariesFormEdit'
]);
# registro asignacion
Route::post('admin/mc_certificates/mc_questionnaries/new', [
    'as' => 'create_mc_certificates_mc_questionnaires',
    'uses' => 'Admin\McCertificatesController@asignQuestionnairesStore'
]);
Route::post('admin/mc_certificates/mc_questionnaries/edit', [
    'as' => 'update_mc_certificates_mc_questionnaires',
    'uses' => 'Admin\McCertificatesController@asignQuestionnairesUpdate'
]);
/* fin asignacion de questionarios*/

/* asignacion de reguntas a certificados*/
Route::get('admin/mc_certificates/asign_question/{id_cert}/list',[
    'as' => 'asignQuestionList',
    'uses' => 'Admin\McCertificatesController@asignQuestionList'
]);
# form de registro question a certificado
Route::get('admin/mc_certificates/asign_question/new/{id_questionnaire}/{id_cert}/{id_cert_quest}',[
    'as' => 'asignQuestionNewForm',
    'uses' => 'Admin\McCertificatesController@asignQuestionNewForm'
]);
Route::get('admin/mc_certificates/asign_question/edit/{id_questionnaire}/{id_cert}/{id_cert_quest}',[
    'as' => 'asignQuestionEditForm',
    'uses' => 'Admin\McCertificatesController@asignQuestionEditForm'
]);
# registro asignacion de preguntas
Route::post('admin/mc_certificates/asignquestion/new', [
    'as' => 'create_asign_question',
    'uses' => 'Admin\McCertificatesController@asignQuestionStore'
]);
Route::post('admin/mc_certificates/asignquestion/edit', [
    'as' => 'update_asign_question',
    'uses' => 'Admin\McCertificatesController@asignQuestionUpdate'
]);
/* fin asignacion de questionarios*/