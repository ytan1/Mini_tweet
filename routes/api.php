<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'api',
], function () {

    Route::post('file', 'UploadController@upload');
    Route::delete('file', 'UploadController@delete');

    Route::get('article', 'ArticleController@getAll');
    Route::post('article','ArticleController@create');

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('me','AuthController@me');
    Route::get('logout', 'AuthController@logout');
});
