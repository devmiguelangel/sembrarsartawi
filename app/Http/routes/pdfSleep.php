<?php


/*
 * Route Client DE
 */
Route::group(['prefix' => '/'], function() {
    Route::get('pdf/sleep/{type}/{id_header}', [
        'as' => 'sleepModalPdf',
        'uses' => 'slipModalController@generaPdf'
    ]);
});
/*
 * Route Client DE
 */
Route::group(['prefix' => '/'], function() {
    Route::get('pdf/sleep/{type}/{id_header}/{aux}', [
        'as' => 'sleepModalAutoPdf',
        'uses' => 'slipModalAutoController@generaPdf'
    ]);
});