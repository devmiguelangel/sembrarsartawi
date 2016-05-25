<?php
//edw
Route::get('td/{rp_id}/td_list_insured/{header_id}/', [
        'as'   => 'td.list.insured',
        'uses' => 'Td\HeaderController@listInsured'
    ]);

/*
 * Route Issuance TD
 */
Route::group([ 'prefix' => 'td/{rp_id}' ], function () {
    /*
     * Header create
     */
    //edw
    Route::get('create', [
        'as'   => 'td.create',
        'uses' => 'Td\HeaderController@create'
    ]);
    //edw
    Route::post('create', [
        'as'   => 'td.store',
        'uses' => 'Td\HeaderController@store'
    ]);
    //edw
    Route::get('create/{header_id}/multiriesgo/insured', [
        'as'   => 'td.mr.insured',
        'uses' => 'Td\HeaderController@insured'
    ]);
    //edw
    Route::get('td_form_insured/{header_id}/{id_detail}/', [
        'as'   => 'td.form.insured',
        'uses' => 'Td\HeaderController@formDetail'
    ]);
    //edw
    Route::post('create_insured', [
        'as'   => 'td.save.insured',
        'uses' => 'Td\HeaderController@storeInsured'
    ]);
    /*
     * resultado Cotizacion
     */
    //edw
    Route::get('create/{header_id}/multiriesgo/res_cotizacion/', [
        'as'   => 'td.result_cot',
        'uses' => 'Td\HeaderController@resultCot'
    ]);
    //edw
    Route::get('create/{header_id}/multiriesgo/emision_poliza/', [
        'as'   => 'td.emision_poliza',
        'uses' => 'Td\HeaderController@edit'
    ]);
    
    /*
     * Header Edit
     */
    //edw
    Route::get('edit/{header_id}', [
        'as'   => 'td.edit',
        'uses' => 'Td\HeaderController@edit'
    ]);
    //edw
    Route::put('edit/{header_id}', [
        'as'   => 'td.update',
        'uses' => 'Td\HeaderController@update'
    ]);

    

    /*
     * Header Result
     */
    Route::get('create/{header_id}/result', [
        'as'   => 'td.result',
        'uses' => 'Td\HeaderController@result'
    ]);

    /*
     * Header issuance
     */
    //edw
    Route::get('issuance/{header_id}/result', [
        'as'   => 'td.show.issuance',
        'uses' => 'Td\HeaderController@showIssuance'
    ]);
    //edw
    Route::get('issue/{header_id}', [
        'as'   => 'td.issue',
        'uses' => 'Td\HeaderController@updateIssuance'
    ]);

    /*
     * Client Edit
     */
    //edw
    Route::get('edit/{header_id}/client/edit/{client_id}', [
        'as'   => 'td.client.i.edit',
        'uses' => 'Td\HeaderController@editClient'
    ]);

    Route::put('edit/{header_id}/client/edit/{client_id}', [
        'as'   => 'td.client.i.update',
        'uses' => 'Td\HeaderController@updateClient'
    ]);

    /*
     * Cancellations
     */
    Route::get('cancel', [
        'as'   => 'td.cancel.lists',
        'uses' => 'Td\CancellationController@lists'
    ]);
    /*
     * Pre-Approved
     */
    Route::get('pre-approved', [
        'as'   => 'td.pre.approved.lists',
        'uses' => 'Td\PreApprovedController@lists'
    ]);
    /*
     * Issue Quote
     */
    Route::get('issue', [
        'as'   => 'td.issue.lists',
        'uses' => 'Td\IssueController@lists'
    ]);

});



