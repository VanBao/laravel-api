<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => ['api'], 'namespace' => 'Api'], function ($router) {

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/{type}', 'PageController@index');
    });

    Route::group(['prefix' => 'city'], function () {
        Route::get('/', 'CityController@index');
    });

    Route::group(['prefix' => 'notifications'], function() {
        Route::get('/','NotificationController@index');
        Route::post('/read','NotificationController@read');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index');
    });

    Route::group(['prefix' => 'service'], function () {
        Route::get('/', 'ServiceController@index');
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::post('/', 'BookingController@create');
        Route::post('/rating', 'BookingController@rating');
        Route::get('/', 'BookingController@history');
        Route::post('/upload', 'BookingController@upload');
        Route::get('/transfer', 'BookingController@transfer');
        Route::post('/generate-code','BookingController@generateBookingCode');
    });

    Route::group(['prefix' => 'request-support'], function () {
        Route::post('/', 'RequestSupportController@create');
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::post('/send', 'ChatController@send');
        Route::post('/upload-image','ChatController@uploadImage');
        Route::get('/messages','ChatController@messages');
        Route::get('/message','ChatController@message');
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('send-code', 'AuthController@sendCode');
        Route::post('submit-code', 'AuthController@submitCode');
        Route::post('change-password', 'AuthController@changePassword');
        Route::post('update-profile', 'AuthController@updateProfile');
        Route::post('upload-avatar', 'AuthController@uploadAvatar');
        Route::get('me', 'AuthController@me');
    });

    Route::group(['prefix' => 'request-support'], function () {
        Route::post('/', 'RequestSupportController@create');
    });

    Route::group(['prefix' => 'payment-method'], function () {
        Route::get('/', 'PaymentMethodController@index');
//        Route::post('/', 'PaymentMethodController@create');
        Route::get('/return', 'PaymentMethodController@return');
    });

    Route::group(['prefix' => 'setting'], function() {
        Route::post('/update', 'SettingController@update');
        Route::get('/', 'SettingController@index');
        Route::get('/system', 'SettingController@system');
    });

});
