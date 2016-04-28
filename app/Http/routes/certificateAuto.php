<?php

/**/
Route::group([ 'prefix' => 'au/{rp_id}/create/{header_id}/' ], function () {
    Route::post('slip_au', [
        'as' => 'au.slip_au',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
});

Route::group([ 'prefix' => 'au/{rp_id}/issuance/{header_id}/' ], function () {
    Route::post('slip_issuance', [
        'as' => 'slip_issuance',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });

    # @INI emision y cotizacion REPORTE POLIZAS EMITIDAS
Route::group([ 'prefix' => '/report/auto/general_emitido/' ], function () {
    Route::post('slip_rep_au_emision', [
        'as' => 'slip_rep_au_emision',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });
Route::group([ 'prefix' => '/report/auto/general_emitido/' ], function () {
    Route::post('slip_rep_au_cot', [
        'as' => 'slip_rep_au_cot',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });
    # @FIN emision y cotizacion REPORTE POLIZAS EMITIDAS
    
    # @INI emision y cotizacion REPORTE GENERALES
Route::group([ 'prefix' => '/report/auto/general/' ], function () {
    Route::post('slip_rep_au_general', [
        'as' => 'slip_rep_au_general',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });
Route::group([ 'prefix' => '/report/auto/general/' ], function () {
    Route::post('slip_rep_au_cot_general', [
        'as' => 'slip_rep_au_cot_general',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });
    # @FIN emision y cotizacion REPORTE GENERALES
    
Route::group([ 'prefix' => '/report/auto/cotizacion/' ], function () {
    Route::post('slip_au_cot', [
        'as' => 'slip_au_cot',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
    });

/**/



/**
Route::post('slip_au', [
        'as' => 'slip_au',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
/**/