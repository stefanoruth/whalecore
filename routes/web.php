<?php

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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->middleware('guest');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest');
Route::post('register', 'Auth\RegisterController@register')->middleware('guest');

Route::middleware('auth')->group(function(){
    Route::get('/', 'SiteController@index');
    Route::resource('sites', 'SiteController')->except(['create']);
    Route::resource('tenant', 'TenantController')->only(['store']);
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('tenancy')->group(function(){
        Route::resource('pages', 'PageController');
        Route::resource('templates', 'TemplateController');
        Route::resource('buckets', 'BucketController');
        Route::resource('components', 'ComponentController');
        Route::resource('media', 'MediaController', ['parameters' => ['media'=>'id'] ]);
    });
});