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
			if (!isset($_SERVER['HTTP_AUTHORIZATION']) || $_SERVER['HTTP_AUTHORIZATION'] == '')
		    {
				return Response::json(array("success" => "test"));
		    }
		    else{
		    	list($email, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
		    }
			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
			   return Response::json(Auth::user());
			}

			return Response::json(array("id" => 0));
		}
	}
?>