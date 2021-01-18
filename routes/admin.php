<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('settings', 'HomeController@settings')->name('settings');
Route::put('update-password', 'HomeController@updatePassword')->name('updatePassword');
Route::put('update-info', 'HomeController@updateInfo')->name('updateInfo');


Route::resource('admins', 'AdminController')->names('admin')->parameters('admin');
Route::resource('pages', 'PagesController')->names('pages')->parameters('page')->except(['show']);
Route::resource('faq', 'FaqController')->names('faq')->parameters('faq')->except(['show']);
Route::resource('country', 'CountryController')->names('country')->parameters('country')->except(['show']);


Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::resource('users', 'UserController')->names('user')->parameters('user');
    Route::group(['as' => 'user'], function () {
        // user routes
    });
});


Route::get('test', function () {
    unlockSite();
});
