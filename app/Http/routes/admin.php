<?php

Route::get('admin', [
    'as'    => 'admin.home',
    'uses'  => 'Admin\HomeController@index'
]);