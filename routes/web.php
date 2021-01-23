<?php

use App\Http\Settings\GeneralSettings;
use App\Models\Site\Faq;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@index")->name('home');

Auth::routes(['verify' => true]);
Route::get('/p/{page:slug}', "PageController")->name('page');
Route::get('faq', 'FaqController')->name('faq');
