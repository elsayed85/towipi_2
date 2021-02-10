<?php

use App\GPRMC;
use App\Models\Product\Order;
use App\Models\Product\Product;
use App\User;
use Illuminate\Support\Facades\Route;

Route::get('/', "HomeController@index")->name('home');
Auth::routes(['verify' => true]);

Route::get('/p/{page:slug}', "PageController")->name('page');
Route::get('faq', 'FaqController')->name('faq');

Route::get('categories/{category:slug}', "CategoryController@index")->name('category.index');
Route::get('product/{product:slug}', "ProductController@show")->name('product.show');
Route::get('product', "ProductController@index")->name('product.index');
