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
