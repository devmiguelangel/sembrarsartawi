<?php

/*
 * Route Client DE
 */
Route::group(['prefix' => 'de/{rp_id}/{header_id}'], function() {
    /**
     * route ajax cotizacion
     */
    Route::post('slip', [
        'as' => 'de.slip',
        'uses' => 'slipModalController@ajaxBuscar'
    ]);
});

Route::group(['prefix' => 'report/'], function() {
    /**
     * route ajax cotizacion
     */
    Route::post('slip', [
        'as' => 'de.slip2',
        'uses' => 'slipModalController@ajaxBuscar'
    ]);
});

Route::post('report/slip/{id_comp}', [
    'as' => 'slip_des_cot',
    'uses' => 'slipModalController@ajaxBuscar'
]);
