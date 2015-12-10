<?php


/*
 * Route Client DE
 */
/**/
Route::group(['prefix' => '/'], function() {
    Route::get('report/general', [
        'as' => 'report.report_general',
        'uses' => 'Report\ReportController@general'
    ]);
    Route::post('report/general', [
        'as' => 'report.report_general_result',
        'uses' => 'Report\ReportController@general'
    ]);
});
/*/

