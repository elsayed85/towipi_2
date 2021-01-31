<?php

use App\Models\Product\Product;
use App\User;
use Illuminate\Support\Facades\Route;

Route::get('/', "HomeController@index")->name('home');
Auth::routes(['verify' => true]);

Route::get('/p/{page:slug}', "PageController")->name('page');
Route::get('faq', 'FaqController')->name('faq');

Route::get('categories/{category:slug}', "CategoryController@index")->name('category.index');
Route::get('product/{product:slug}', "ProductController@show")->name('product.show');


//fawry
Route::get('test', function () {
    // Get user
    $user = User::find(50);
    $cardNumber = "4242424242424242";
    $expiryYear = "21";
    $expiryMonth = "05";
    $cvv = "100";

    $refNumber = 123;

    $fawry = app("fawry");

    $payment = $fawry->chargeViaFawry($refNumber , $user , "5543474002259998" , 100 , Product::all()->random(5)->toArray() , "desc here");

    dd($payment);
    //dd(app("fawry")->deleteCardToken($user));

    //$tokenResponse = app("fawry")->createCardToken($cardNumber, $expiryYear, $expiryMonth, $cvv, $user);

    //dd($tokenResponse, app("fawry")->listCustomerTokens($user));
});

// paypal
Route::view('pay', 'site.payment.test');
Route::view('failed', 'site.payment.failed');
Route::view('success', 'site.payment.success');
