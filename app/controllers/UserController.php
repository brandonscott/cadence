<?php
	class UserController extends BaseController{

		protected $fillable = array('email', 'firstname', 'lastname');
		protected $guarded = array('id', 'password');
		
		public function getAll()
		{
			App::singleton('pubnub', function()
			{
				$publish_key   = Config::get('pubnub.publish_key');
				$subscribe_key = Config::get('pubnub.subscribe_key');
			    
			    return new Pubnub($publish_key, $subscribe_key);
			});

			$pubnub = App::make('pubnub');
			//return var_dump($pubnub);
			$pubnub->publish(array(
			'channel' => 'Cadence',
			'message' => array(
				'user' => "Jimmy",
				'text' => "Test",
			)));
			return Response::json(User::all());
		}

		public function store()
		{
			return User::create([
				"email"			=> Input::get("email"),
				"firstname"		=> Input::get("firstname"),
				"lastname"		=> Input::get("lastname")
			]);
		}
	}
?>