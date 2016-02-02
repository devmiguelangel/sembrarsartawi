<?php

/**
 * PROCESOS GET
**/

Route::get('admin/exchange/list/{nav}/{action}',[
    'as'   => 'admin.exchange.list',
    'uses' => 'Admin\ExchangeAdminController@index'
]);

Route::get('admin/exchange/new/{nav}/{action}',[
    'as' => 'admin.exchange.new',
    'uses' => 'Admin\ExchangeAdminController@index'
]);

Route::get('admin/exchange/edit/{nav}/{action}/{id_exchange}', [
    'as' => 'admin.exchange.edit',
    'uses' => 'Admin\ExchangeAdminController@edit'
]);

/**
 * PROCESOS POST
 **/

Route::post('admin/exchange/new' ,[
    'as' => 'create_exchange',
    'uses' => 'Admin\ExchangeAdminController@store'
]);

Route::post('admin/exchange/edit', [
    'as' => 'update_exchange',
    'uses' => 'Admin\ExchangeAdminController@update'
]);

