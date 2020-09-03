<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\RequestSupport;
use App\Service;
use App\UserSetting;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use GuzzleHttp\Client;
use App\Page;
use Illuminate\Http\Request;

Route::get('/', 'LoginController@showLoginForm');

Route::get('/booking/create', 'BookingController@createByCustomer');

Route::get('/dieu-khoan-su-dung', 'PageController@term');

Route::get('/pages/{id}', 'PageController@page')->where('id', '[0-9]+');

Route::get('/optimize', 'PageController@optimize');

Auth::routes();

Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');


Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    Route::group(['as' => 'dashboard.'], function () {
        Route::get('/', 'DashboardController@index')->name('index')->middleware('can:dashboard');
        Route::post('/chart', 'DashboardController@chart')->name('chart')->middleware('can:dashboard-chart');
        Route::post('/booking/export','DashboardController@export')->name('export.booking')->middleware('can:export-booking');
        Route::get('/booking/download','DashboardController@download')->name('download.booking')->middleware('can:download-booking');
    });

    Route::group(['as' => 'page.', 'prefix' => 'page'], function () {
        Route::get('/', 'PageController@index')->name('index')->middleware('can:page');
        Route::get('/create', 'PageController@create')->name('create')->middleware('can:page-create');
        Route::post('/store', 'PageController@store')->name('store')->middleware('can:page-store');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit')->where('id', '[0-9]+')->middleware('can:page-edit');
        Route::post('/update/{id}', 'PageController@update')->name('update')->where('id', '[0-9]+')->middleware('can:page-update');
        Route::get('/delete/{id}', 'PageController@delete')->name('delete')->where('id', '[0-9]+')->middleware('can:page-delete');
    });

    Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {
        Route::get('/', 'NotificationController@index')->name('index')->middleware('can:notification');
        Route::get('/detail/{id}', 'NotificationController@detail')->where('id', '[0-9]+')->name('detail')->middleware('can:notification-detail');
        Route::post('/send', 'NotificationController@send')->name('send')->middleware('can:notification-send');
        Route::post('/upload-image', 'NotificationController@uploadImage')->name('upload-image')->middleware('can:notification-upload-image');
    });

    Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
        Route::get('/', 'StaffController@index')->name('index')->middleware('can:staff');
        Route::get('/detail/{id}', 'StaffController@detail')->name('detail')->where('id', '[0-9]+')->middleware('can:staff-detail');
        Route::post('/update', 'StaffController@update')->name('update')->middleware('can:staff-update');
        Route::get('/pagination', 'StaffController@pagination')->name('pagination');
    });

    Route::group(['prefix' => 'onesignal', 'as' => 'onesignal.'], function () {
        Route::post('/upload', 'OneSignalController@update')->name('update');
    });

    Route::post('/upload', 'UploadController@upload')->name('upload')->middleware('can:upload');

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', 'CategoryController@index')->name('index')->middleware('can:category');
        Route::get('/create', 'CategoryController@create')->name('create')->middleware('can:category-create');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit')->where('id', '[0-9]+')->middleware('can:category-edit');
        Route::post('/store', 'CategoryController@store')->name('store')->middleware('can:category-store');
        Route::post('/update/{id}', 'CategoryController@update')->name('update')->where('id', '[0-9]+')->middleware('can:category-update');
        Route::post('/delete/{id?}', 'CategoryController@delete')->name('delete')->where('id', '[0-9]+')->middleware('can:category-delete');
    });

    Route::group(['prefix' => 'request-support', 'as' => 'request-support.'], function () {
        Route::get('/', 'RequestSupportController@index')->name('index')->middleware('can:request-support');
        Route::get('/detail/{id}', 'RequestSupportController@detail')->name('detail')->where('id', '[0-9]+')->middleware('can:request-support-detail');
        Route::post('/update/{id}', 'RequestSupportController@update')->name('update')->where('id', '[0-9]+')->middleware('can:request-support-update');
        Route::post('/answer/{id}', 'RequestSupportController@answer')->name('answer')->where('id', '[0-9]+')->middleware('can:request-support-answer');
    });

    Route::group(['prefix' => 'ranking', 'as' => 'ranking.'], function () {
        Route::get('/', 'RankingController@index')->name('index')->middleware('can:ranking');
    });

    Route::group(['prefix' => 'rating', 'as' => 'rating.'], function () {
        Route::get('/', 'RatingController@index')->name('index')->middleware('can:rating');
        Route::get('/detail/{id}', 'RatingController@detail')->name('detail')->where('id', '[0-9]+')->middleware('can:rating-detail');
        Route::get('/read/{id}', 'RatingController@read')->name('read')->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
        Route::get('/', 'BookingController@index')->name('index')->middleware('can:booking');
        Route::get('/create', 'BookingController@create')->name('create')->middleware('can:booking-create');
        Route::get('/detail/{id}', 'BookingController@detail')->name('detail')->where('id', '[0-9]+')->middleware('can:booking-detail');
        Route::post('/assign', 'BookingController@assign')->name('assign')->middleware('can:booking-assign');
        Route::post('/reject', 'BookingController@reject')->name('reject')->middleware('can:booking-reject');
        Route::post('/update/{id}', 'BookingController@update')->name('update')->where('id', '[0-9]+')->middleware('can:booking-update');
        Route::get('/delete/{id}', 'BookingController@delete')->name('delete')->where('id', '[0-9]+')->middleware('can:booking-delete');
        Route::post('/update-deal-price', 'BookingController@updateDealPrice')->name('update-deal-price')->middleware('can:booking-update-deal-price');
        Route::post('/store', 'BookingController@store')->name('store');
        Route::get('/pagination', 'BookingController@pagination')->name('pagination');
        Route::group(['prefix' => 'load'], function () {
            Route::get('/{table}', 'BookingController@load')->name('load');
        });
    });

    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::get('/', 'ServiceController@index')->name('index')->middleware('can:service');
        Route::get('/create', 'ServiceController@create')->name('create')->middleware('can:service-create');
        Route::get('/edit/{id}', 'ServiceController@edit')->name('edit')->where('id', '[0-9]+')->middleware('can:service-edit');
        Route::post('/store', 'ServiceController@store')->name('store')->middleware('can:service-store');
        Route::post('/update/{id}', 'ServiceController@update')->name('update')->where('id', '[0-9]+')->middleware('can:service-update');
        Route::post('/delete/{id?}', 'ServiceController@delete')->name('delete')->where('id', '[0-9]+')->middleware('can:service-delete');
    });

    Route::group(['prefix' => 'group', 'as' => 'group.'], function () {
        Route::get('/', 'GroupController@index')->name('index')->middleware('can:group');
        Route::get('/create', 'GroupController@create')->name('create')->middleware('can:group-create');
        Route::get('/edit/{id}', 'GroupController@edit')->name('edit')->middleware('can:group-edit');
        Route::post('/store', 'GroupController@store')->name('store')->middleware('can:group-store');
        Route::post('/update/{id}', 'GroupController@update')->name('update')->middleware('can:group-update');
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@index')->name('index')->middleware('can:user');
        Route::get('/create', 'UserController@create')->name('create')->middleware('can:user-create');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit')->where('id', '[0-9]+')->middleware('can:user-edit');
        Route::post('/store', 'UserController@store')->name('store')->middleware('can:user-store');
        Route::post('/update/{id}', 'UserController@update')->name('update')->where('id', '[0-9]+')->middleware('can:user-update');
        Route::get('/delete/{id}','UserController@delete')->name('delete')->where('id','[0-9]+')->middleware('can:user-delete');
        Route::get('/profile', 'UserController@profile')->name('profile')->middleware('can:user-profile');
        Route::post('/update-profile', 'UserController@updateProfile')->name('update-profile')->middleware('can:user-update-profile');
        Route::post('/change-password', 'UserController@changePassword')->name('change-password')->middleware('can:user-change-password');
    });

    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', 'RoleController@index')->name('index')->middleware('can:rule');
        Route::get('/create', 'RoleController@create')->name('create')->middleware('can:rule-create');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit')->where('id', '[0-9]+')->middleware('can:rule-edit');
        Route::post('/store', 'RoleController@store')->name('store')->middleware('can:rule-store');
        Route::post('/update/{id}', 'RoleController@update')->name('update')->where('id', '[0-9]+')->middleware('can:rule-update');
        Route::get('/delete/{id}', 'RoleController@delete')->name('delete')->where('id', '[0-9]+')->middleware('can:rule-delete');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('/', 'SettingController@index')->name('index')->middleware('can:setting');
        Route::post('/update', 'SettingController@update')->name('update')->middleware('can:setting-update');
    });

    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('/load-messages', 'ChatController@loadMessages')->name('load-messages')->middleware('can:chat-load-messages');
        Route::post('/send-message', 'ChatController@sendMessage')->name('send-message')->middleware('can:chat-send-message');
        Route::post('/upload-image', 'ChatController@uploadImage')->name('upload-image')->middleware('can:chat-upload-image');
        Route::post('/read-all', 'ChatController@readAll')->name('read-all');
    });
});



