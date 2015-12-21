<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'auth'], function() {
    /*
     * Authentication
     */
    require 'routes/auth.php';

});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'is_user'], function() {
        /*
         * Home
         */
        Route::get('/', function() {
            return redirect()->route('home');
        });

        Route::get('home', [
            'as'   => 'home',
            'uses' => 'HomeController@index'
        ]);

        /*
         * Header DE
         */
        require 'routes/de.issuance.php';

        require 'routes/de.client.php';

        require 'routes/de.question.php';

        require 'routes/certificate.php';

        require 'routes/report.php';
    });

    /*
     * Administrator
     */
    Route::group(['middleware' => 'is_admin'], function() {
        require 'routes/admin.php';
    });
});
