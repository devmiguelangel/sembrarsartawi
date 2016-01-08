<?php
Route::get('admin/company/list/{nav}/{action}',[
    'as'   => 'admin.company.list',
    'uses' => 'Admin\CompanyAdminController@index'
]);

Route::get('admin/company/edit/{nav}/{action}/{id_company}', [
    'as' => 'admin.company.edit',
    'uses' => 'Admin\CompanyAdminController@edit'
]);

Route::get('admin/company/new/{nav}/{action}', [
    'as' => 'admin.company.new',
    'uses' => 'Admin\CompanyAdminController@index'
]);