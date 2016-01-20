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
Route::get('admin/mc_certificates/questionnaires/question/{id_cert}/list',[
    'as' => 'mcCertificateCuestionnairesList',
    'uses' => 'Admin\McCertificatesController@certificateCuestionnairesList'
]);
Route::get('admin/mc_certificates/questionnaires/question/new/{id}',[
    'as' => 'mcCertificateCuestionnairesNewForm',
    'uses' => 'Admin\McCertificatesController@certificateCuestionnairesNewForm'
]);
Route::get('admin/mc_certificates/questionnaires/question/edit/{id}',[
    'as' => 'mcCertificateCuestionnairesEditForm',
    'uses' => 'Admin\McCertificatesController@certificateCuestionnairesEditForm'
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