<?php

/*
 * Route Issuance DE
 */
Route::group(['prefix' => 'de/{rp_id}'], function() {
    /*
     * Header create
     */
    Route::get('create', [
        'as'    => 'de.create',
        'uses'  => 'De\HeaderController@create'
    ]);

    Route::post('create', [
        'as'    => 'de.store',
        'uses'  => 'De\HeaderController@store'
    ]);

    /*
     * Header result on Quote
     */
    Route::get('{header_id}/result', [
        'as'    => 'de.result',
        'uses'  => 'De\HeaderController@result'
    ]);

    Route::post('{header_id}/result', [
        'as'    => 'de.store.result',
        'uses'  => 'De\HeaderController@storeResult'
    ]);

    /*
     * Header edit
     */
    Route::get('{header_id}/edit', [
        'as'    => 'de.edit',
        'uses'  => 'De\HeaderController@edit'
    ]);

    Route::put('{header_id}/edit', [
        'as'    => 'de.update',
        'uses'  => 'De\HeaderController@update'
    ]);

    /*
     * Header Issuance
     */
    Route::get('{header_id}/issue', [
        'as'    => 'de.issue',
        'uses'  => 'De\HeaderController@issue'
    ]);

    Route::get('{header_id}/issuance', [
        'as'    => 'de.issuance',
        'uses'  => 'De\HeaderController@issuance'
    ]);

    /*
     * Header Facultative
     */
    Route::get('{header_id}/request-approval', [
        'as'    => 'de.fa.request',
        'uses'  => 'De\FacultativeController@request'
    ]);

});