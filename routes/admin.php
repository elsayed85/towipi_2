<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('settings', 'HomeController@settings')->name('settings');
Route::put('update-password', 'HomeController@updatePassword')->name('updatePassword');
Route::put('update-info', 'HomeController@updateInfo')->name('updateInfo');


Route::resource('admins', 'AdminController')->names('admin')->parameters('admin');
