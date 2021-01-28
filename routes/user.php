<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/', 'OrdersController@index')->name('index');
});

Route::group(['prefix' => 'wishlist', 'as' => 'wishlist.'], function () {
    Route::get('/', "WishlistController@index")->name('index');
    Route::delete('{wishlist}/delete', "WishlistController@destroy")->name('destroy');
    Route::post('{wishlist}/move-to-cart', "WishlistController@moveToCart")->name('moveToCart');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', "CartController@index")->name('index');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/', "ProfileController@index")->name('index');
    Route::put('update-info', "ProfileController@updateInfo")->name('update_info');
    Route::put('update-password', "ProfileController@updatePassword")->name('update_password');
});

Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
    Route::get('/', "AddressController@index")->name('index');
    Route::post('/add_new_address', 'AddressController@store')->name('store');
    Route::put('{address}/update', 'AddressController@update')->name('update');
    Route::delete('{address}/delete', 'AddressController@destroy')->name('destroy');
});
