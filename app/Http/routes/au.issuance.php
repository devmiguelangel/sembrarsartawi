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

    Route::put('edit/{header_id}/{id_facultative}', [
        'as'   => 'au.update.fa',
        'uses' => 'Au\HeaderController@updateFa'
    ]);

    /*
     * Header Result
     */
    Route::get('create/{header_id}/result', [
        'as'   => 'au.result',
        'uses' => 'Au\HeaderController@result'
    ]);

    /*
     * Header issuance
     */
    Route::get('issuance/{header_id}', [
        'as'   => 'au.show.issuance',
        'uses' => 'Au\HeaderController@showIssuance'
    ]);

    Route::get('issue/{header_id}', [
        'as'   => 'au.issue',
        'uses' => 'Au\HeaderController@updateIssuance'
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

    /*
     * Header Facultative
     */
    Route::get('request-approval/{header_id}', [
        'as'   => 'au.fa.request.create',
        'uses' => 'Au\HeaderController@requestCreate'
    ]);

    Route::put('request-approval/{header_id}', [
        'as'   => 'au.fa.request.store',
        'uses' => 'Au\HeaderController@requestStore'
    ]);

});

Route::group([ 'prefix' => 'fau/{rp_id}' ], function () {
    /*
     * Facultative process
     */
    Route::get('facultative/edit/{id}', [
        'as'   => 'au.fa.edit',
        'uses' => 'Au\FacultativeController@edit'
    ]);

    Route::put('facultative/edit/{id}', [
        'as'   => 'au.fa.update',
        'uses' => 'Au\FacultativeController@update'
    ]);

    Route::get('facultative/{id}/observation', [
        'as'   => 'au.fa.observation',
        'uses' => 'Au\FacultativeController@observation'
    ]);

    Route::get('facultative/{id}/answer/{id_observation}', [
        'as'   => 'au.fa.create.answer',
        'uses' => 'Au\FacultativeController@createAnswer'
    ]);

    Route::put('facultative/{id}/answer/{id_observation}', [
        'as'   => 'au.fa.store.answer',
        'uses' => 'Au\FacultativeController@storeAnswer'
    ]);

    Route::get('facultative/{id}/response/{id_observation}', [
        'as'   => 'au.fa.response',
        'uses' => 'Au\FacultativeController@response'
    ]);

    Route::get('facultative/{id}/observation-process', [
        'as'   => 'au.fa.observation.process',
        'uses' => 'Au\FacultativeController@observationProcess'
    ]);

    Route::put('facultative/read/edit/{id}', [
        'as'   => 'au.fa.read.update',
        'uses' => 'Au\FacultativeController@readUpdate'
    ]);

});