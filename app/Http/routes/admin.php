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

Route::get('admin/user/edit/{nav}/{action}/{id_user}', [
    'as' => 'admin.user.edit',
    'uses' => 'Admin\UserAdminController@edit'
]);

Route::get('admin/user/change-password/{nav}/{action}/{id_user}', [
    'as' => 'admin.user.change-password',
    'uses' => 'Admin\UserAdminController@edit'
]);

Route::get('admin/user/reset-password/{nav}/{action}/{id_user}', [
    'as' => 'admin.user.reset-password',
    'uses' => 'Admin\UserAdminController@edit'
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

//procesos ajax
Route::get('admin/user/agency_ajax/{id_depto}', 'Admin\UserAdminController@ajax_agency');
Route::get('admin/user/finduser_ajax/{usuario}', 'Admin\UserAdminController@ajax_finduser');
Route::get('admin/user/pass_now_ajax/{id_user}/{contrasenia_actual}', 'Admin\UserAdminController@ajax_current_password');
Route::get('admin/user/active_ajax/{id_user}/{text}', 'Admin\UserAdminController@ajax_active_inactive');

require "admin.company.php";
require "admin.exchange.php";
require "admin.de.php";
require "admin.question.php";
require "admin.city.php";
require "admin.agency.php";
require "admin.addquestion.php";