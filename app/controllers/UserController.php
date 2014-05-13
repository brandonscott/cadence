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
			$user->default_servergroup = 1;//ServerGroup::all()->first()->id;

			$user->save();

			return Response::json($user);
		}

		public function getDefaultServerGroup($id)
		{
			$user = User::find($id);
			$serverGroup = ServerGroup::find($user->default_servergroup);
			return Response::json($serverGroup);
		}

		public function deleteUser($id)
		{
			$user = User::find($id);
			$user->delete();

			return Response::json(array("success" => true));
		}

	    public function getSubscriptions($id)
		{
			$user = User::find($id);
			$subscriptions = $user->subscription;
	
			return Response::json($subscriptions->each(function($subscription){
				return $subscription->serverGroup;
			}));
		}

		public function updateSubscription($id, $subId)
		{
			$subscription = Subscription::find($subId);
			$subscription->text = Input::get('text');
			$subscription->phonecall = Input::get('phonecall');
			$subscription->save;

			return Response::json($subscription);
		}

		public function getUser($id)
		{
			return Response::json(User::find($id));
		}

	}
?>