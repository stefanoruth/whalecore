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

Route::domain('app.'.config('app.url'))->group(function () {
    Route::view('/', 'app')->middleware('auth');
    
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
    Route::get('logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
    Route::post('login', 'Auth\LoginController@login')->middleware('guest');
    
    Route::middleware('auth')->prefix('api')->group(function () {
        Route::apiResource('projects', 'ProjectController');
        Route::apiResource('tenant', 'TenantController')->only(['store', 'index']);
        Route::apiResource('languages', 'LanguageController')->only(['index']);
        
        Route::middleware('tenancy')->group(function () {
            Route::apiResource('items', 'ItemController');
            Route::apiResource('roles', 'RoleController')->only(['index']);
            Route::apiResource('templates', 'TemplateController');
            Route::apiResource('media', 'MediaController', ['parameters' => ['media'=>'id']])->only(['index','store','destroy']);
            Route::apiResource('subscriptions', 'SubscriptionController');
            Route::apiResource('projects/members', 'ProjectMemberController')->only(['store', 'destroy', 'update']);
            Route::apiResource('projects/api', 'ProjectApiController', ['as' => 'projects', 'parameters' => ['api' => 'id']])->only(['update']);
        });
    });
    
    Route::post('stripe/webhook', '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');
});

Route::apiResource('mail/subscribe', 'MailSubscriptionController')->only(['store', 'destroy']);
Route::post('register', 'Auth\RegisterController@register')->middleware('guest')->name('register');
Route::view('/', 'welcome');
