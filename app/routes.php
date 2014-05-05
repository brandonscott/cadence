<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return "Hello World";
});

Route::get('/jimmy', function()
{ 
	return Response::json("Jimmy");
});

Route::get('/users', 'UserController@getAll');
Route::get('/users/store', 'UserController@store');

Route::get('/pulse', 'PulseController@getAll');
Route::post('/pulse', 'PulseController@store');

Route::any('/pubnub', 'pubnub::simplechat@index');
Route::any('(:bundle)/login', 'pubnub::simplechat@login');
Route::any('(:bundle)/logout', 'pubnub::simplechat@logout');