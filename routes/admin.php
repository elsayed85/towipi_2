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

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('{order}', 'OrderController@show')->name('show');
    Route::delete('{order}', 'OrderController@destroy')->name('destroy');
    Route::post('{order}/tracking', 'OrderController@trackingAction')->name('tracking.action');
    Route::patch('{order}/{item}/returned/action', 'OrderController@returnedItemAction')->name('returned_item_action');
});

Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
    Route::get('/', 'PaymentController@index')->name('index');
    Route::get('{payment}', 'PaymentController@show')->name('show');
    Route::delete('{payment}', 'PaymentController@destroy')->name('destroy');
});

Route::group(['prefix' => 'users', 'namespace' => 'User', 'as' => 'users.'], function () {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('{user}', 'UserController@show')->name('show');
    Route::get('{user}/edit', 'UserController@edit')->name('edit');
    Route::match(['put', 'patch'], '{user}', 'UserController@update')->name('update');
    Route::delete('{user}', 'UserController@destroy')->name('destroy')->middleware(['password.confirm']);
    Route::post('{user}/toggle-activate', 'UserController@toggleActivate')->name('toggle_activate');
});

Route::group(['prefix' => 'products', 'namespace' => 'Product', 'as' => 'product.'], function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('create', 'ProductController@create')->name('create');
    Route::post('/', 'ProductController@store')->name('store');
    Route::get('{product}', 'ProductController@show')->name('show');
    Route::get('{product}/edit', 'ProductController@edit')->name('edit');
    Route::match(['patch', 'put'], '{product}', 'ProductController@update')->name('update');
    Route::delete('{product}', 'ProductController@destroy')->name('destroy')->middleware(['password.confirm']);

    Route::resource('/p/category', 'CategoryController')->names('category')->parameters('category');

    Route::get('/returned/items', 'ReturnedItemsController@index')->name('returned.index');
    Route::patch('/returned/items/{item}/action', 'ReturnedItemsController@changeState')->name('returned.change_state');
    Route::delete('/returned/items/{item}', 'ReturnedItemsController@destroy')->name('returned.destroy');

    Route::get('/{product}/upload-images', 'ProductController@upload')->name('upload_images');
    Route::post('/{product}/upload-images', 'ProductController@uploadImages')->name('upload_images');
    Route::delete('/{product}/upload-images/{image}', 'ProductController@deleteImage')->name('delete_image');

    Route::group(['prefix' => 'options', 'as' => 'options.'], function () {
        Route::get('{product}/options/create', 'optionController@create')->name('create');
        Route::post('{product}/options', 'optionController@store')->name('store');
        Route::delete('{product}/options/{option}', 'optionController@deleteOption')->name('delete_option');
        Route::delete('{product}/options/value/{value}', 'optionController@deleteOptionValue')->name('delete_value');
    });

});

Route::get("complaints", "ComplaintController@index")->name('complaints.index');

Route::group(['prefix' => 'website', 'as' => 'website.'], function () {
    Route::get('settings', 'WebsiteSettingsController@settings')->name('settings');
    Route::put('site-name', 'WebsiteSettingsController@ChangeSiteName')->name('change_site_name');
    Route::put('logos', 'WebsiteSettingsController@changeLogos')->name('change_logos');
    Route::put('status', 'WebsiteSettingsController@siteStatus')->name('status');
    Route::put('social', 'WebsiteSettingsController@socialLinks')->name('social_links');
});
