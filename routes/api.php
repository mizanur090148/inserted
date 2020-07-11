<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function() {
	Route::get('/users', 'UserController@index');
	Route::post('users', 'UserController@store');
	Route::patch('users/{id}', 'UserController@update');
	Route::delete('users/{id}', 'UserController@delete');	

    Route::get('/projects', 'ProjectController@index');	
	Route::post('projects', 'ProjectController@store');
	Route::patch('projects/{id}', 'ProjectController@update');
	Route::delete('projects/{id}', 'ProjectController@delete');

	Route::get('/user-projects', 'UserProjectController@index');
	Route::post('user-projects', 'UserProjectController@store');
	Route::patch('user-projects/{id}', 'UserProjectController@update');
	Route::delete('user-projects/{id}', 'UserProjectController@delete');
});