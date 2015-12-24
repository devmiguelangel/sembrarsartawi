<?php
Route::get('admin/company/list/{nav}/{action}',[
    'as'   => 'admin.company.list',
    'uses' => 'Admin\CompanyAdminController@index'
]);

Route::get('admin/company/edit_company/{nav}/{action}/{id_company}', [
    'as' => 'admin.company.edit_company',
    'uses' => 'Admin\CompanyAdminController@edit'
]);

Route::get('admin/company/new_company/{nav}/{action}', [
    'as' => 'admin.company.new_company',
    'uses' => 'Admin\CompanyAdminController@index'
]);