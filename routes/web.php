<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "HomeController@index")->name('home');
Auth::routes(['verify' => true]);

Route::get('/p/{page:slug}', "PageController")->name('page');
Route::get('faq', 'FaqController')->name('faq');

Route::get('categories/{category:slug}', "CategoryController@index")->name('category.index');
Route::get('product/{product:slug}', "ProductController@show")->name('product.show');
