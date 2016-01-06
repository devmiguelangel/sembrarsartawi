<?php
/**
 PROCESOS GET
 **/

Route::get('admin/de/addquestion/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.addquestion.list',
    'uses' => 'Admin\AddQuestionAdminController@index'
]);