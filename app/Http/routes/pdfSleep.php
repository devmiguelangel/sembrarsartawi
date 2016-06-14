<?php


/*
 * Route Client DE
 */
Route::group(['prefix' => '/'], function() {
    Route::get('pdf/sleep/{type}/{id_header}/{aux}', [
        'as' => 'sleepModalPdf',
        'uses' => 'slipModalController@generaPdf'
    ]);
});
/*
 * Route Client AU
 */
Route::group(['prefix' => '/'], function() {
    Route::get('pdf/sleep_auto/{type}/{id_header}/{aux}', [
        'as' => 'sleepModalAutoPdf',
        'uses' => 'slipModalAutoController@generaPdf'
    ]);
});