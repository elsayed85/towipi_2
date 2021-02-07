<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::post('get-governorates', "AddressController@getGovernorates")->name('get_governorates');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/', 'OrdersController@index')->name('index');
    Route::post('{order}/{item}/add-rate', "OrdersController@addRate")->name('add_rate');
    Route::post('{order}/{item}/add-complaint', "OrdersController@addComplaint")->name('add_complaint');
    Route::post('{order}/{item}/return-item', "OrdersController@addItemToReturnedItems")->name('return_item');
});

Route::group(['prefix' => 'wishlist', 'as' => 'wishlist.'], function () {
    Route::get('/', "WishlistController@index")->name('index');
    Route::delete('{wishlist}/delete', "WishlistController@destroy")->name('destroy');
    Route::post('remove-ajax', "WishlistController@destroyAjax")->name('destroy_ajax');
    Route::post('{wishlist}/move-to-cart', "WishlistController@moveToCart")->name('moveToCart');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::post('add/{product}', "CartController@store")->name('store');
    Route::delete('remove/{item}', "CartController@remove")->name('remove');
    Route::post('clear', "CartController@clear")->name('clear');
});

Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
    Route::get('/', 'CheckoutController@getCheckout')->name('index');
    Route::post('/create-order', 'CheckoutController@checkout')->name('checkout');
    Route::get('{order}/shipping', 'CheckoutController@shipping')->name('shipping');
    Route::post('{order}/shipping/add-new-address', 'CheckoutController@addNewAddress')->name('add_new_address');
    Route::post('{order}/shipping/select-address', 'CheckoutController@selectAddress')->name('select_address');
    Route::get('{order}/payment', 'CheckoutController@payment')->name('payment');
    Route::get('{order}/payment/final', 'CheckoutController@finalStep')->name('final_step');
    Route::post('{order}/payment/cashondelivery', 'CheckoutController@cashOnDelivery')->name('cash_on_delivery');
});


Route::group(['prefix' => 'payment', 'as' => 'payment.', 'namespace' => "Payment"], function () {
    Route::post('{order}/pyapal/setup-transaction', 'PaypalController@setUpTransaction')->name('paypal.setup_transaction');
    Route::post('{order}/pyapal/verify-transaction', 'PaypalController@verifyTransaction')->name('paypal.verify_transaction');

    Route::get('{order}/fawry/success', 'FawryController@success')->name('fawry.success');
    Route::get('{order}/fawry/failed', 'FawryController@failed')->name('fawry.failed');
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
