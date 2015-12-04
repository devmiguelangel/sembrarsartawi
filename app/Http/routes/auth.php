<?php

Route::get('login', [
    'as'   => 'auth.login.get',
    'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('login', [
    'as'   => 'auth.login.post',
    'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('logout', [
    'as'   => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);