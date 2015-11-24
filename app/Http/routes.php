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
     * Route Issuance DE
     */
    Route::group(['prefix' => 'de/{rp_id}'], function() {
        /*
         * Header create
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
         * Header result on Quote
         */
        Route::get('{header_id}/result', [
            'as'    => 'de.result',
            'uses'  => 'De\HeaderController@result'
        ]);

        Route::post('{header_id}/result', [
            'as'    => 'de.store.result',
            'uses'  => 'De\HeaderController@storeResult'
        ]);

        /*
         * Header edit
         */
        Route::get('{header_id}/edit', [
            'as'    => 'de.edit',
            'uses'  => 'De\HeaderController@edit'
        ]);

        Route::put('{header_id}/edit', [
            'as'    => 'de.update',
            'uses'  => 'De\HeaderController@update'
        ]);

        /*
         * Header Issuance
         */
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
         * Client create
         */
        Route::get('client/create/{client_id?}', [
            'as'    => 'de.detail.create',
            'uses'  => 'De\DetailController@create'
        ]);

        Route::post('client/create', [
            'as'    => 'de.detail.store',
            'uses'  => 'De\DetailController@store'
        ]);

        /*
         *  Search Client
         */
        Route::post('client/search', [
            'as'    => 'de.client.search',
            'uses'  => 'Client\ClientController@search'
        ]);

        /*
         * Client edit
         */
        Route::get('client/edit/{detail_id}', [
            'as'    => 'de.detail.edit',
            'uses'  => 'De\DetailController@edit'
        ]);

        Route::put('client/edit/{detail_id}', [
            'as'    => 'de.detail.update',
            'uses'  => 'De\DetailController@update'
        ]);

        /*
         * Client edit complementary data
         */
        Route::get('edit/detail/edit/{detail_id}/{ref}', [
            'as'    => 'de.detail.i.edit',
            'uses'  => 'De\DetailController@editIssue'
        ]);

        Route::put('edit/detail/edit/{detail_id}/{ref}', [
            'as'    => 'de.detail.i.update',
            'uses'  => 'De\DetailController@updateIssue'
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

        /* ***********************************************
         * Vida Sub Product list
         */
        Route::get('vi/{sp_id}', [
            'as'    => 'de.vi.sp.list',
            'uses'  => 'De\HeaderController@viSPList'
        ]);

        /*
         * Vida Sub Product save list
         */
        Route::post('vi/{sp_id}', [
            'as'    => 'de.vi.sp.list.store',
            'uses'  => 'De\HeaderController@viSPListStore'
        ]);

        /*
         * Sub Product Create
         */
        Route::get('vi/{sp_id}/create', [
            'as'    => 'de.vi.sp.create',
            'uses'  => 'Vi\HeaderController@createSubProduct'
        ]);
    });

    /*
     * Route Question
     */
    Route::group(['prefix' => 'de/{rp_id}/{header_id}/client/{detail_id}'], function() {
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