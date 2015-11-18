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
     * Route Authentication
     */
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
     * Route Home
     */
    Route::get('/', function() {
        return redirect()->route('home');
    });

    Route::get('home', [
        'as'   => 'home',
        'uses' => 'HomeController@index'
    ]);

    /*
     * Route Issuance DE
     */
    Route::group(['prefix' => 'de/{rp_id}'], function() {
        /*
         * Create new Header
         */
        Route::get('create', [
            'as'    => 'de.create',
            'uses'  => 'De\HeaderController@create'
        ]);

        Route::post('create', [
            'as'    => 'de.store',
            'uses'  => 'De\HeaderController@store'
        ]);

        /*
         *
         */
        Route::get('{header_id}/result', [
            'as'    => 'de.result',
            'uses'  => 'De\HeaderController@result'
        ]);

        Route::get('{header_id}/edit', [
            'as'    => 'de.edit',
            'uses'  => 'De\HeaderController@edit'
        ]);

        Route::put('{header_id}/edit', [
            'as'    => 'de.update',
            'uses'  => 'De\HeaderController@update'
        ]);

        Route::get('{header_id}/issue', [
            'as'    => 'de.issue',
            'uses'  => 'De\HeaderController@issue'
        ]);

        Route::get('{header_id}/issuance', [
            'as'    => 'de.issuance',
            'uses'  => 'De\HeaderController@issuance'
        ]);
    });

    /*
     * Route Client DE
     */
    Route::group(['prefix' => 'de/{rp_id}/{header_id}'], function() {
        /*
         * Client list
         */
        Route::get('list', [
            'as'    => 'de.client.list',
            'uses'  => 'Client\ClientController@lists'
        ]);

        /*
         * Create new Client
         */
        Route::get('client/create/', [
            'as'    => 'de.client.create',
            'uses'  => 'Client\ClientController@create'
        ]);

        Route::post('client/create', [
            'as'    => 'de.client.store',
            'uses'  => 'Client\ClientController@store'
        ]);

        /*
         *
         */
        Route::post('client/search', [
            'as'    => 'de.client.search',
            'uses'  => 'Client\ClientController@search'
        ]);

        Route::get('client/edit/{client_id}', [
            'as'    => 'de.client.edit',
            'uses'  => 'Client\ClientController@edit'
        ]);

        Route::put('client/edit/{client_id}', [
            'as'    => 'de.client.update',
            'uses'  => 'Client\ClientController@update'
        ]);

        Route::get('edit/client/edit/{client_id}/{ref}', [
            'as'    => 'de.client.i.edit',
            'uses'  => 'Client\ClientController@issueEdit'
        ]);

        Route::put('edit/client/edit/{client_id}', [
            'as'    => 'de.client.i.store',
            'uses'  => 'Client\ClientController@issueStore'
        ]);

        /*
         * Route Beneficiary DE
         */
        Route::get('beneficiary/create/{detail_id}', [
            'as'    => 'de.beneficiary.create',
            'uses'  => 'De\BeneficiaryController@create'
        ]);

        Route::post('beneficiary/create/{detail_id}', [
            'as'    => 'de.beneficiary.store',
            'uses'  => 'De\BeneficiaryController@store'
        ]);
    });

    /*
     * Route Question
     */
    Route::group(['prefix' => 'de/{rp_id}/{header_id}/client/{client_id}'], function() {
        Route::get('question/create', [
            'as'    => 'de.question.create',
            'uses'  => 'Client\QuestionController@create'
        ]);

        Route::post('question/create', [
            'as'    => 'de.question.store',
            'uses'  => 'Client\QuestionController@storeDe'
        ]);
    });
});