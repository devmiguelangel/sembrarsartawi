<?php

/*
 * Route Issuance DE
 */
Route::group(['prefix' => 'de/{rp_id}'], function() {
    /*
     * Client list
     */
    Route::get('{header_id}/list', [
        'as'    => 'de.client.list',
        'uses'  => 'De\HeaderController@lists'
    ]);

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

    Route::put('{header_id}/edit/{id_facultative}', [
        'as'    => 'de.update.fa',
        'uses'  => 'De\HeaderController@updateFa'
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
        'as'    => 'de.fa.request.create',
        'uses'  => 'De\HeaderController@requestCreate'
    ]);

    Route::put('{header_id}/request-approval', [
        'as'    => 'de.fa.request.store',
        'uses'  => 'De\HeaderController@requestStore'
    ]);

    /*
     * Cancellations
     */
    Route::get('cancel', [
        'as'    => 'de.cancel.lists',
        'uses'  => 'De\CancellationController@lists'
    ]);

    Route::get('cancel/{header_id}/create', [
        'as'    => 'de.cancel.create',
        'uses'  => 'De\CancellationController@create'
    ]);

    Route::post('cancel/{header_id}/create', [
        'as'    => 'de.cancel.store',
        'uses'  => 'De\CancellationController@store'
    ]);

    /*
     * Pre-Approved
     */
    Route::get('pre-approved', [
        'as'    => 'de.pre.approved.lists',
        'uses'  => 'De\PreApprovedController@lists'
    ]);

    /*
     * Issue Quote
     */
    Route::get('issue', [
        'as'    => 'de.issue.lists',
        'uses'  => 'De\IssueController@lists'
    ]);

});

Route::group(['prefix' => '{rp_id}'], function() {
    /*
     * Facultative process
     */
    Route::get('facultative/edit/{id}', [
        'as'    => 'de.fa.edit',
        'uses'  => 'De\FacultativeController@edit'
    ]);

    Route::put('facultative/edit/{id}', [
        'as'    => 'de.fa.update',
        'uses'  => 'De\FacultativeController@update'
    ]);

    Route::get('facultative/{id}/observation', [
        'as'    => 'de.fa.observation',
        'uses'  => 'De\FacultativeController@observation'
    ]);

    Route::get('facultative/{id}/answer/{id_observation}', [
        'as'    => 'de.fa.create.answer',
        'uses'  => 'De\FacultativeController@createAnswer'
    ]);

    Route::put('facultative/{id}/answer/{id_observation}', [
        'as'    => 'de.fa.store.answer',
        'uses'  => 'De\FacultativeController@storeAnswer'
    ]);

    Route::get('facultative/{id}/response/{id_observation}', [
        'as'    => 'de.fa.response',
        'uses'  => 'De\FacultativeController@response'
    ]);

    Route::get('facultative/{id}/observation-process', [
        'as'    => 'de.fa.observation.process',
        'uses'  => 'De\FacultativeController@observationProcess'
    ]);

    /*
     * Medical Certificate
     */
    Route::get('facultative/{id}/mc/create', [
        'as'    => 'de.fa.mc.create',
        'uses'  => 'De\MedicalCertificateController@create'
    ]);

    Route::post('facultative/{id}/mc/create', [
        'as'    => 'de.fa.mc.store',
        'uses'  => 'De\MedicalCertificateController@store'
    ]);

});