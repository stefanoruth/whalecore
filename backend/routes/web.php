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

Route::view('/', 'app')->middleware('auth');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::get('logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
Route::post('login', 'Auth\LoginController@login')->middleware('guest');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest');
Route::post('register', 'Auth\RegisterController@register')->middleware('guest');


Route::middleware('auth')->prefix('api')->group(function () {
    Route::apiResource('projects', 'ProjectController');
    Route::apiResource('tenant', 'TenantController')->only(['store']);

    Route::middleware('tenancy')->group(function () {
        Route::apiResource('items', 'ItemController');
        Route::apiResource('templates/types', 'TemplateTypeController')->only(['index']);
        Route::apiResource('roles', 'RoleController')->only(['index']);
        Route::apiResource('templates', 'TemplateController');
        Route::apiResource('media', 'MediaController', ['parameters' => ['media'=>'id']]);
        Route::apiResource('projects/members', 'ProjectMemberController')->only(['store', 'destroy', 'update']);
        Route::apiResource('projects/api', 'ProjectApiController', ['as' => 'projects', 'parameters' => ['api' => 'id']])->only(['update']);
    });
});
