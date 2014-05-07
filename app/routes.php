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

Route::get('/users', 'UserController@getAll');
Route::post('/users', 'UserController@store');

Route::get('/auth', 'AuthenticationController@auth');

Route::get('/pulses', 'PulseController@getAll');
Route::post('/pulses', 'PulseController@store');

Route::group(array('before' => 'superadmin.auth'), function() {
	Route::get('/servers/{id}', 'ServerController@getServer');
	Route::put('/servers/{id}', 'ServerController@updateServerDetails');
	Route::get('/servers', 'ServerController@getAll');
	Route::post('/servers', 'ServerController@store');
	Route::put('/servers/{guid}/status', 'ServerController@changeStatus');
	Route::get('/servers/{id}/pulses', 'ServerController@getPulses');
	Route::get('/servers/{id}/pulses/latest', 'ServerController@getLatestPulse');
	Route::get('/servers/{id}/pulses/{days}', 'ServerController@getPulsesForDays');
	
});

Route::any('/pubnub', 'pubnub::simplechat@index');
Route::any('(:bundle)/login', 'pubnub::simplechat@login');
Route::any('(:bundle)/logout', 'pubnub::simplechat@logout');