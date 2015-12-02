<?php

Route::get('admin/{nav?}', [
    'as'    => 'admin.home',
    'uses'  => 'Admin\HomeAdminController@index'
]);

Route::get('admin/user/list/{nav}',[
    'as'   => 'admin.user.list',
    'uses' => 'Admin\UserAdminController@index'
]);