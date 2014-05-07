<?php
	class UserController extends BaseController{

		protected $fillable = array('email', 'first_name', 'last_name', 'mobile_number');
		protected $guarded = array('id', 'password', 'privilege_id');
		
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
			/*return User::create([
				"email"			=> Input::get("email"),
				"firstname"		=> Input::get("firstname"),
				"lastname"		=> Input::get("lastname")
			]);*/
			$user = new User;
			$user->privilege_id = Input::get("privilege_id");
			$user->password = Input::get("password");
			$user->email = Input::get("email");
			$user->first_name = Input::get("first_name");
			$user->last_name = Input::get("last_name");
			$user->mobile_number = Input::get("mobile_number");

			$user->save();

			return Response::json($user);
		}
	}
?>