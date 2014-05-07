<?php
	class AuthenticationController extends BaseController{
		
		public function getAll()
		{
			
			
		}

		public function store()
		{
			
		}

		public function auth()
		{
			if (Auth::attempt(array('email' => $_SERVER['PHP_AUTH_USER'], 'password' => $_SERVER['PHP_AUTH_PW'])))
			{
			   return Response::json(array("success" => true));
			}

			return Response::json(array("success" => false));
		}
	}
?>