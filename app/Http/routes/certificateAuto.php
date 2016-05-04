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

    

    Route::post('report/auto/general/slip/{id_comp}', [
        'as' => 'slip_rep_au_general',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);


    Route::post('report/auto/cotizacion/slip/{id_comp}', [
        'as' => 'slip_au_cot',
        'uses' => 'slipModalAutoController@ajaxBuscar'
    ]);
