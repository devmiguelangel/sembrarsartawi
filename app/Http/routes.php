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

Route::get('/', ['middleware' => 'auth', function() {
    return redirect()->route('home');
}]);

Route::get('home', [
    'as'   => 'home',
    'uses' => 'HomeController@index'
]);


/*
 * Route Authentication
 */
Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [
        'as'   => 'auth.login.get',
        'uses' => 'Auth\AuthController@getLogin'
    ]);

    Route::post('login', [
        'as'   => 'auth.login.post',
        'uses' => 'Auth\AuthController@postLogin'
    ]);

    Route::get('logout', [
        'as'   => 'auth.logout',
        'uses' => 'Auth\AuthController@getLogout'
    ]);
});


Route::group(['middleware' => 'auth'], function() {

    /*
     * Route Header DE
     */
    Route::group(['prefix' => 'de'], function() {
        Route::get('create', [
            'as'    => 'de.create',
            'uses'  => 'De\HeaderDeController@create'
        ]);

        Route::post('create', [
            'as'    => 'de.store',
            'uses'  => 'De\HeaderDeController@store'
        ]);
    });

    /*
     * Route Client DE
     */
    Route::group(['prefix' => 'de/{header_id}'], function() {
        Route::get('list', [
            'as'    => 'de.client.list',
            'uses'  => 'Client\ClientController@index'
        ]);

        Route::get('client/create', [
            'as'    => 'de.client.create',
            'uses'  => 'Client\ClientController@create'
        ]);

        Route::post('client', [
            'as'    => 'de.client.store',
            'uses'  => 'Client\ClientController@store'
        ]);
    });

    /*
     * Route Question
     */
    Route::group(['prefix' => 'de/{header_id}/client/{client_id}'], function() {
        Route::get('question/create', [
            'as'    => 'de.question.create',
            'uses'  => 'Client\QuestionController@create'
        ]);

        /*Route::post('question', [
            'as'    => 'de.client.store',
            'uses'  => 'Client\ClientController@store'
        ]);*/
    });


});