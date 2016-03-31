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
     * Vehicle create
     */
    Route::get('{header_id}/vehicle/lists', [
        'as'   => 'au.vh.lists',
        'uses' => 'Au\DetailController@lists'
    ]);

    Route::get('{header_id}/vehicle/create', [
        'as'   => 'au.vh.create',
        'uses' => 'Au\DetailController@create'
    ]);

    Route::post('{header_id}/vehicle/create', [
        'as'   => 'au.vh.store',
        'uses' => 'Au\DetailController@store'
    ]);

    /*
     * Vehicle destroy
     */
    Route::delete('{header_id}/vehicle/delete/{detail_id}', [
        'as'   => 'au.vh.destroy',
        'uses' => 'Au\DetailController@destroy'
    ]);

});