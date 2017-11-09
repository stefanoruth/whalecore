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

Route::auth();
Route::middleware('auth')->group(function(){
    Route::get('/', 'DashboardController@index');
    Route::resource('sites', 'SiteController');
    Route::get('logout', 'Auth\LoginController@logout');

    Route::middleware('tenancy')->group(function(){
        Route::resource('pages', 'PageController');
        Route::resource('templates', 'TemplateController');
        Route::resource('buckets', 'BucketController');
        Route::resource('components', 'ComponentController');
        Route::resource('media', 'MediaController');
    });
});