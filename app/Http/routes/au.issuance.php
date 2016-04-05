<?php

/*
 * Route Issuance AU
 */
Route::group([ 'prefix' => 'au/{rp_id}' ], function () {
    /*
     * Header create
     */
    Route::get('create', [
        'as'   => 'au.create',
        'uses' => 'Au\HeaderController@create'
    ]);

    Route::post('create', [
        'as'   => 'au.store',
        'uses' => 'Au\HeaderController@store'
    ]);

    /*
     * Header Edit
     */
    Route::get('edit/{header_id}', [
        'as'   => 'au.edit',
        'uses' => 'Au\HeaderController@edit'
    ]);

    Route::put('edit/{header_id}', [
        'as'   => 'au.update',
        'uses' => 'Au\HeaderController@update'
    ]);

    /*
     * Header Result
     */
    Route::get('create/{header_id}/result', [
        'as'   => 'au.result',
        'uses' => 'Au\HeaderController@result'
    ]);

    /*
     * Client Edit
     */
    Route::get('edit/{header_id}/client/edit/{client_id}', [
        'as'   => 'au.client.i.edit',
        'uses' => 'Au\HeaderController@editClient'
    ]);

    Route::put('edit/{header_id}/client/edit/{client_id}', [
        'as'   => 'au.client.i.update',
        'uses' => 'Au\HeaderController@updateClient'
    ]);

    /*
     * Vehicle create
     */
    Route::get('create/{header_id}/vehicle/lists', [
        'as'   => 'au.vh.lists',
        'uses' => 'Au\DetailController@lists'
    ]);

    Route::get('create/{header_id}/vehicle/create', [
        'as'   => 'au.vh.create',
        'uses' => 'Au\DetailController@create'
    ]);

    Route::post('create/{header_id}/vehicle/create', [
        'as'   => 'au.vh.store',
        'uses' => 'Au\DetailController@store'
    ]);

    /*
     * Vehicle destroy
     */
    Route::delete('create/{header_id}/vehicle/delete/{detail_id}', [
        'as'   => 'au.vh.destroy',
        'uses' => 'Au\DetailController@destroy'
    ]);

    /*
     * Vehicle edit
     */
    Route::get('create/{header_id}/vehicle/edit/{detail_id}', [
        'as'   => 'au.vh.edit',
        'uses' => 'Au\DetailController@edit'
    ]);

    Route::put('create/{header_id}/vehicle/edit/{detail_id}', [
        'as'   => 'au.vh.update',
        'uses' => 'Au\DetailController@update'
    ]);

    /*
     * Vehicle edit issuance
     */
    Route::get('edit/{header_id}/vehicle/edit/{detail_id}', [
        'as'   => 'au.vh.i.edit',
        'uses' => 'Au\DetailController@editIssuance'
    ]);

    Route::put('edit/{header_id}/vehicle/edit/{detail_id}', [
        'as'   => 'au.vh.i.update',
        'uses' => 'Au\DetailController@updateIssuance'
    ]);


});