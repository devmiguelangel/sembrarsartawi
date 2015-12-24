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

Route::get('admin/user/edit/{nav}/{action}', [
    'as' => 'admin.user.edit',
    'uses' => 'Admin\UserAdminController@index'
]);

Route::get('admin/user/change-password/{nav}/{action}', [
    'as' => 'admin.user.change-password',
    'uses' => 'Admin\UserAdminController@index'
]);

Route::get('admin/user/reset-password/{nav}/{action}', [
    'as' => 'admin.user.reset-password',
    'uses' => 'Admin\UserAdminController@index'
]);

require "admin.company.php";