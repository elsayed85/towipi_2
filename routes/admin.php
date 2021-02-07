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
Route::resource('governorate', 'GovernorateController')->names('governorate')->parameters('governorate')->except(['show']);


Route::group(['prefix' => 'orders' , 'as' => 'orders.'], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('{order}', 'OrderController@show')->name('show');
    Route::delete('{order}', 'OrderController@destroy')->name('destroy');
    Route::post('{order}/tracking', 'OrderController@trackingAction')->name('tracking.action');
    Route::patch('{order}/{item}/returned/action', 'OrderController@returnedItemAction')->name('returned_item_action');
});


Route::get('payments', 'PaymentController@index')->name('payments.index');

Route::group(['prefix' => 'users', 'namespace' => 'User', 'as' => 'users.'], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('{user}', 'UserController@show')->name('show');
    Route::post('{user}/toggle-activate', 'UserController@toggleActivate')->name('toggle_activate');
});

Route::group(['prefix' => 'product', 'namespace' => 'Product', 'as' => 'product.'], function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('{product}', 'ProductController@show')->name('show');
});


Route::group(['prefix' => 'website', 'as' => 'website.'], function () {
    Route::get('settings', 'WebsiteSettingsController@settings')->name('settings');
    Route::put('site-name', 'WebsiteSettingsController@ChangeSiteName')->name('change_site_name');
    Route::put('logos', 'WebsiteSettingsController@changeLogos')->name('change_logos');
    Route::put('status', 'WebsiteSettingsController@siteStatus')->name('status');
    Route::put('social', 'WebsiteSettingsController@socialLinks')->name('social_links');
});
