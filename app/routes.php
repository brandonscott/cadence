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

//Auth route
Route::get('/auth', 'AuthenticationController@auth');

Route::group(array('before' => 'superadmin.auth'), function() {

	//User routes
	Route::get('/users', 'UserController@getAll');
	Route::get('/users/{id}', 'UserController@getUser');
	Route::get('/users/{id}/servergroups/default', 'UserController@getDefaultServerGroup');
	Route::post('/users', 'UserController@store');
	Route::delete('/users/{id}', 'UserController@deleteUser');
	Route::get('/users/{id}/subscriptions', 'UserController@getSubscriptions');
	Route::put('/users/{id}', 'UserController@updateUser');
	Route::put('/users/password', 'UserController@changePassword');
	

	//Pulse routes
	Route::get('/pulses', 'PulseController@getAll');
	Route::post('/pulses', 'PulseController@store');
	Route::delete('/pulses/{id}', 'PulseController@deletePulse');

	//Server routes
	Route::get('/servers/unassigned', 'ServerController@getUnassignedServers');
	Route::get('/servers/assigned', 'ServerController@getAssignedServers');
	Route::put('/servers/{id}/servergroup', 'ServerController@updateServerGroup');
	Route::get('/servers/status/{status}', 'ServerController@getServersForStatus');
	Route::get('/servers/{id}', 'ServerController@getServer');
	Route::put('/servers/{guid}', 'ServerController@updateServerDetails');
	Route::delete('/servers/{id}', 'ServerController@deleteServer');
	Route::get('/servers', 'ServerController@getAll');
	Route::post('/servers', 'ServerController@store');
	Route::put('/servers/{guid}/status', 'ServerController@changeStatus');
	Route::get('/servers/{guid}/status', 'ServerController@getStatus');
	Route::get('/servers/{id}/pulses', 'ServerController@getPulses');
	Route::get('/servers/{id}/pulses/latest', 'ServerController@getLatestPulse');
	Route::get('/servers/{id}/pulses/{days}', 'ServerController@getPulsesForDays');

	//Server Group routes
	Route::get('/servergroups', 'ServerGroupController@getAll');
	Route::get('/servergroups/{id}', 'ServerGroupController@getServerGroup');
	Route::post('/servergroups', 'ServerGroupController@store');
	Route::put('/servergroups/{id}', 'ServerGroupController@editServerGroup');
	Route::delete('/servergroups/{id}', 'ServerGroupController@deleteServerGroup');
	Route::get('/servergroups/{id}/servers', 'ServerGroupController@getServers');

	//Privileges routes
	Route::get('/privileges', 'PrivilegeController@getAll');
	Route::post('/privileges', 'PrivilegeController@store');
	Route::delete('/privileges/{id}', 'PrivilegeController@deletePrivilege');

	//Subscription routes
	Route::get('/subscriptions', 'SubscriptionController@getAll');
	Route::post('/subscriptions', 'SubscriptionController@store');
	Route::put('/subscriptions/{id}', 'SubscriptionController@updateSubscription');
	Route::delete('/subscriptions/{id}', 'SubscriptionController@deleteSubscription');
});