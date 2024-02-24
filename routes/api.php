<?php

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\CouponsController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\NotificationsController;

Route::group(['namespace' => 'Api'], function () {

    Route::post('register', 'UsersController@register');

    Route::post('login', 'UsersController@login');

    Route::post('Login-with-apple','UsersController@Login_with_apple');
    Route::post('Login-with-google','UsersController@Login_with_google');
    // forget Password
    Route::post('forget_password', 'UsersController@forget_password');
    Route::post('check_forget_code', 'UsersController@check_forget_code');
    Route::post('change_password', 'UsersController@change_password');

    Route::get('banks', 'PackagesController@banks');
    Route::get('settings', 'SettingsController@settings');
    Route::get('banners', 'SettingsController@banners');
    Route::get('informationssettings', 'SettingsController@informationssettings');
    Route::get('brands', 'DataController@brands');
    Route::get('categories', 'DataController@categories');
    Route::get('home/{category_id}', 'CouponsController@home');
    Route::post('filter', 'CouponsController@filter');
    Route::post('search', 'CouponsController@search');
    Route::get('offers_coupons', 'CouponsController@offers_coupons');

    Route::post('item-thumb/{type}','CouponsController@thumb');

    Route::get('offers_sliders', 'CouponsController@offers_sliders');
    Route::post('suggest_coupon', 'CouponsController@suggest_coupon');
    Route::post('send_help', 'CouponsController@send_help');
    Route::get('settings', 'DataController@settings');
    Route::post('complaints','CouponsController@complaints');
    Route::get('use_coupon/{coupon_id}', 'CouponsController@use_coupon');

    Route::resource('notifications', 'NotificationsController');

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('logout', 'UsersController@logout');
        Route::post('update_profile', 'UsersController@update_profile');
        Route::post('change_old_password', 'UsersController@change_old_password');
        Route::delete('delete_all_notifications', 'NotificationsController@delete_all_notifications');


        Route::get('delete_used_coupon/{coupon_id}', 'CouponsController@delete_used_coupon');
        Route::post('favourite_coupon', 'CouponsController@favourite_coupon');
        Route::post('coupon_review', 'CouponsController@coupon_review');
        Route::get('favourites', 'CouponsController@favourites');
        Route::get('used_coupons', 'CouponsController@used_coupons');

    });


});
