<?php

class Pubnub_Simplechat_Controller extends Controller {
	
	public $restful = true;

	public function get_index()
	{
		if ( ! Session::has('user'))
			return Redirect::to_action('pubnub::simplechat@login');
		
		return View::make('pubnub::simplechat');
	}

	public function post_index()
	{
		if (Input::get('text') === '')
			return false;

		IoC::resolve('pubnub')->publish(array(
			'channel' => 'simplechat',
			'message' => array(
				'user' => Session::get('user'),
				'text' => Input::get('text'),
			),
		));
	}

	public function get_login()
	{
		if (Session::has('user'))
			return Redirect::to_action('pubnub::simplechat@index');

		return View::make('pubnub::simplechat_login');
	}

	public function post_login()
	{
		if (Input::get('user') !== '')
			Session::put('user', Input::get('user'));

		return Redirect::to_action('pubnub::simplechat@index');
	}

	public function get_logout()
	{
		Session::forget('user');
		return Redirect::to_action('pubnub::simplechat@index');
	}
}