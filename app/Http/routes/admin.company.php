<?php
Route::get('admin/company/list/{nav}/{action}',[
    'as'   => 'admin.company.list',
    'uses' => 'Admin\CompanyAdminController@index'
]);