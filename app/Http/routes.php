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

Route::get('/', ['middleware' => 'auth', function () {
    return redirect()->route('home');
}]);

Route::get('home', ['as' => 'home', function () {
        return view('home');
    }
]);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['middleware' => 'auth'], function () {

    // Crear una solicitud
    Route::get('de/create', [
        'as'    => 'de.create',
        'uses'  => 'De\HeaderController@create'
    ]);

    Route::post('de/create', [
        'as'    => 'de.store',
        'uses'  => 'De\HeaderController@store'
    ]);
});