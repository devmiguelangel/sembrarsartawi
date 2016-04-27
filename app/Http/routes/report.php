<?php


/*
 * Route Client DE
 */
Route::group(['prefix' => '/'], function() {
    # ruta desgravamen
    
    Route::get('report/general', [
        'as' => 'report.report_general',
        'uses' => 'Report\ReportController@general'
    ]);    
    Route::post('report/general', [
        'as' => 'report.report_general_result',
        'uses' => 'Report\ReportController@general'
    ]);
    
    Route::get('report/general_emitido', [
        'as' => 'report.report_general_emitido',
        'uses' => 'Report\ReportController@general_emitido'
    ]);    
    Route::post('report/general_emitido', [
        'as' => 'report.report_general_result_emitido',
        'uses' => 'Report\ReportController@general_emitido'
    ]);
    
    Route::get('report/cotizacion', [
        'as' => 'report.report_cotizacion',
        'uses' => 'Report\ReportController@cotizacion'
    ]);
    Route::post('report/cotizacion', [
        'as' => 'report.report_cotizacion_result',
        'uses' => 'Report\ReportController@cotizacion'
    ]);
    
    # ruta Automoviles
    
    Route::get('report/auto/cotizacion', [
        'as' => 'report.auto_report_cotizacion',
        'uses' => 'Report\ReportAutoController@cotizacion'
    ]);
    Route::post('report/auto/cotizacion', [
        'as' => 'report.auto_report_cotizacion_result',
        'uses' => 'Report\ReportAutoController@cotizacion'
    ]);
});