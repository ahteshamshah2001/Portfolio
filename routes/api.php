<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    route::post('contactStore', 'ContactController@store');


    Route::group(['prefix' => 'setting'], function () {
        route::post('storeContractorOpportunity', 'SettingController@storeContractorOpportunity');
        route::post('storeResumes', 'SettingController@storeResumes');
        route::post('showEmployments', 'SettingController@showEmployments');
        route::get('showContractor', 'SettingController@showContractor');
        route::get('showDepart', 'SettingController@showDepart');
        route::post('newsLetterStore', 'NewsLetterController@store');
        route::post('quoteStore', 'QueriesController@store');
        route::get('showGenderStatus', 'SettingController@showGenderStatus');
        route::get('showDuration', 'SettingController@showDuration');
        route::get('showJobStatus', 'SettingController@showJobStatus');
        route::get('showUserStatus', 'SettingController@showUserStatus');
        route::get('showCountry', 'SettingController@showCountry');
        route::get('showState/{id}', 'SettingController@showState');
        route::get('showPage', 'SettingController@showPage');
    });

    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::post('store', 'AuthController@store')->name('store');
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('forgot-password', 'ForgotPasswordController@reset_password_request');
        Route::post('reset-password', 'ForgotPasswordController@reset_password_submit');
    });
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'user'], function () {
            route::get('info', 'UserController@info');
            route::post('changePassword', 'UserController@changePassword');
            route::post('update', 'UserController@update');
            route::get('logout', 'UserController@logout');
        });
    });
});


