<?php

Route::get('admin/{nav?}', [
    'as'    => 'admin.home',
    'uses'  => 'Admin\HomeAdminController@index'
]);

Route::get('admin/user/list/{nav}/{action}',[
    'as'   => 'admin.user.list',
    'uses' => 'Admin\UserAdminController@index'
]);

Route::get('admin/user/new/{nav}/{action}', [
    'as' => 'admin.user.new',
    'uses' => 'Admin\UserAdminController@index'
]);

Route::get('admin/user/edit/{nav}/{action}/{id_user}/{id_retailer}', [
    'as' => 'admin.user.edit',
    'uses' => 'Admin\UserAdminController@edit'
]);

Route::get('admin/user/change-password/{nav}/{action}/{id_user}/{id_retailer}', [
    'as' => 'admin.user.change-password',
    'uses' => 'Admin\UserAdminController@edit'
]);

Route::get('admin/user/reset-password/{nav}/{action}/{id_user}/{id_retailer}', [
    'as' => 'admin.user.reset-password',
    'uses' => 'Admin\UserAdminController@edit'
]);

Route::get('admin/user/import-file/{nav}/{action}', [
    'as' => 'admin.user.import-file',
    'uses' => 'Admin\UserAdminController@upload_file'
]);

Route::get('active_inactive_user/{id_user}/{text}', [
    'as' => 'active_inactive_user',
    'uses' => 'Admin\UserAdminController@ajax_active_inactive'
]);

Route::post('admin/user/new', [
    'as' => 'create_user',
    'uses' => 'Admin\UserAdminController@store'
]);

Route::post('admin/user/edit', [
    'as' => 'update_user',
    'uses' => 'Admin\UserAdminController@update'
]);

Route::post('admin/user/change', [
    'as' => 'change_pass',
    'uses' => 'Admin\UserAdminController@change'
]);

Route::post('admin/user/reset', [
    'as' => 'reset_pass',
    'uses' => 'Admin\UserAdminController@reset'
]);

Route::post('admin/user/import-file', [
    'as' => 'upload_data_users',
    'uses' => 'Admin\UserAdminController@upload_file_data_user'
]);

//procesos ajax
Route::get('admin/user/agency_ajax/{id_retailer_city}', 'Admin\UserAdminController@ajax_agency');
Route::get('admin/user/finduser_ajax/{usuario}', 'Admin\UserAdminController@ajax_finduser');
Route::get('admin/user/pass_now_ajax/{id_user}/{contrasenia_actual}', 'Admin\UserAdminController@ajax_current_password');
/*Route::get('admin/user/active_ajax/{id_user}/{text}', 'Admin\UserAdminController@ajax_active_inactive');*/
Route::get('admin/user/profiles_ajax/{session_type_user}', 'Admin\UserAdminController@ajax_user_profiles');
Route::get('admin/user/disabled_ajax/{id_user}', 'Admin\UserAdminController@ajax_disabled_permissions');
Route::get('admin/user/find_email_ajax/{email}', 'Admin\UserAdminController@ajax_find_email');
Route::get('admin/user/find_email_edit_ajax/{email}/{id_usuario}', 'Admin\UserAdminController@ajax_find_email_edit');
Route::get('admin/user/city_ajax/{id_retailer}', 'Admin\UserAdminController@ajax_city');
Route::get('admin/user/permissions_ajax/{user_type}', 'Admin\UserAdminController@ajax_permissions');


require "admin.company.php";
require "admin.exchange.php";
require "admin.de.php";
require "admin.question.php";
require "admin.city.php";
require "admin.agency.php";
require "admin.addquestion.php";
require "admin.retailer.php";
require "admin.product.php";
require "admin.addprodcomp.php";
require "admin.addtoretailer.php";
require "admin.policy.php";
require "admin.adActivities.php";
require "admin.mcQuestionnaries.php";
require "admin.mcQuestions.php";
require "admin.mcCertificates.php";
require "admin.vi.php";
require "admin.email.php";
require "admin.planes.php";
require "admin.content.php";
require "admin.subproduct.php";
require "admin.coverage.php";
require "admin.tasas.php";
require "admin.state.php";
require "admin.form.php";
require "admin.modality.php";
require "admin.au.php";
require "admin.increment.php";
require "admin.payment.php";
require "admin.adVehicleTypes.php";
require "admin.adVehicleMakes.php";
require "admin.adVehicleModels.php";

Route::get('admin/ad_activities/list',[
    'as' => 'adActivities',
    'uses' => 'Admin\AdActivitiesController@index'
]);

/* retailer product activities*/
Route::get('admin/ad_retailer_product_activities/list',[
    'as' => 'adRetailerProductActivities',
    'uses' => 'Admin\AdRetailerProductActivitiesController@index'
]);
Route::get('admin/retailer_product_activities/form_new',[
    'as' => 'retailerProductActivitiesFormNew',
    'uses' => 'Admin\AdRetailerProductActivitiesController@formNew'
]);
Route::get('admin/retailer_product_activities/form_edit/{id}',[
    'as' => 'retailerProductActivitiesFormEdit',
    'uses' => 'Admin\AdRetailerProductActivitiesController@edit'
]);
Route::get('admin/retailer_product_activities/destroy/{id}',[
    'as' => 'retailerProductActivitiesFormDestroy',
    'uses' => 'Admin\AdRetailerProductActivitiesController@destroy'
]);
# registro y edicion
Route::post('admin/ad_retailer_product_activities/new', [
    'as' => 'create_ad_retailer_product_activities',
    'uses' => 'Admin\AdRetailerProductActivitiesController@store'
]);
Route::post('admin/ad_retailer_product_activities/edit/{id}', [
    'as' => 'update_ad_retailer_product_activities',
    'uses' => 'Admin\AdRetailerProductActivitiesController@update'
]);

/* activities */

Route::get('admin/ad_activities/list',[
    'as' => 'adActivitiesList',
    'uses' => 'Admin\AdActivitiesController@index'
]);
Route::get('admin/a_activities/form_new',[
    'as' => 'adActivitiesFormNew',
    'uses' => 'Admin\AdActivitiesController@create'
]);
Route::get('admin/ad_activities/form_edit/{id}',[
    'as' => 'adActivitiesFormEdit',
    'uses' => 'Admin\AdActivitiesController@edit'
]);
Route::get('admin/ad_activities/destroy/{id}',[
    'as' => 'adActivitiesFormDestroy',
    'uses' => 'Admin\AdActivitiesController@destroy'
]);

Route::get('admin/adActivities/import-file', [
    'as' => 'import_activities',
    'uses' => 'Admin\AdActivitiesController@import_file'
]);

# registro y edicion
Route::post('admin/ad_activities/new', [
    'as' => 'create_ad_activities',
    'uses' => 'Admin\AdActivitiesController@store'
]);
Route::post('admin/ad_activities/edit/{id}', [
    'as' => 'update_ad_activities',
    'uses' => 'Admin\AdActivitiesController@update'
]);
Route::post('admin/adActivities', [
    'as' => 'process_upload_form',
    'uses' => 'Admin\AdActivitiesController@upload_files'
]);
