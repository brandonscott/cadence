<?php
	class ServerController extends BaseController {
		
		public function getAll()
		{
			return Response::json(Server::all());
		}

		public function getServer($id)
		{
			$server = Server::find($id);
			//return Response::json(array('server' => json_decode($server), 'pulses' => json_decode($server->pulse)));
			return Response::json($server);
		}

		public function store()
		{
			$server = new Server;

			$server->servergroup_id = Input::get("servergroup_id");
			$server->name = Input::get("name");
			$server->available_disk = Input::get("available_disk");
			$server->available_ram = Input::get("available_ram");
			$server->cpu_speed = Input::get("cpu_speed");
			$server->os_name = Input::get("os_name");
			$server->os_version = Input::get("os_version");
			$server->guid = Input::get("guid");

			$server->save();

			$pubnub = App::make('pubnub');
			$pubnub->publish(array(
				'channel' => 'Cadence',
				'message' => json_decode($server)
			));

			return Response::json($server);
		}

		public function getPulses($id)
		{
			$server = Server::find($id);
			return Response::json($server->pulse);
		}

		public function getPulsesForDays($id, $days)
		{
			$server = Server::find($id);
			$pulses = Pulse::ofServerID($id)->ofDays($days)->get();
			return Response::json($pulses);
		}

		public function getLatestPulse($id)
		{
			$pulse = Pulse::ofServerID($id)->orderby('timestamp', 'asc')->first();
			return Response::json($pulse);
		}

		public function changeStatus($guid)
		{
			Server::where('guid', '=', $guid)->update(array('online' => Input::get("status")));
			$server = Server::where('guid', '=', $guid)->get();

			if($server->isEmpty())
			{
				return Response::make("Server with this GUID not found");
			}

			$subscriptionsForServer = Subscription::ofServerID($server->first()->servergroup_id)->get();
			foreach ($subscriptionsForServer as $subscription)
			{
				if (Input::get("status") == 0)
				{
					if($subscription->text == 1)
					{
						Twilio::message($subscription->user->mobile_number, "CADENCE STATUS ALERT: Server '" . $server->first()->name . "' has gone offline.  Urgent attention needed.");
					}
					if($subscription->phonecall == 1)
					{
						Twilio::call($subscription->user->mobile_number, 'http://cadence-bu.cloudapp.net/voicealert.xml');
					}
				}
				else
				{
					if($subscription->text == 1)
					{
						Twilio::message($subscription->user->mobile_number, "CADENCE STATUS UPDATE: Server '" . $server->first()->name . "' has come back online.  Have a great day.");
					}
				}
			}

			$pubnub = App::make('pubnub');
			$pubnub->publish(array(
				'channel' => 'pulses-' . $server->first()->id . '-online',
				'message' => json_encode(array("online" => Input::get("status")))
			));

			return Response::json($server->first());
		}

		public function updateServerDetails($guid)
		{
			$server = Server::where('guid', '=', $guid)->first()->update(array(
				"available_disk" => Input::get("available_disk"),
				"available_ram" => Input::get("available_ram"),
				"cpu_speed" => Input::get("cpu_speed"),
				"os_name" => Input::get("os_name"),
				"os_version" => Input::get("os_version")
			));
			return Response::json(Server::where('guid', '=', $guid)->get());
		}

		public function updateServerGroup($id)
		{
			$server = Server::find($id);

			$server->servergroup_id = Input::get('servergroup_id');
			$server->save();
		}

		public function getStatus($guid)
		{
			$server = Server::where('guid', '=', $guid)->get();
			return Response::json($server);
		}

		public function deleteServer($id)
		{
			$server = Server::find($id);
			$server->delete();

			return Response::json(array("success" => true));
		}

		public function getUnassignedServers()
		{
			return Response::json(Server::ofUnassigned(0)->get());
		}

		public function getAssignedServers()
		{
			return Response::json(Server::ofAssigned(0)->get());
		}

		public function getServersForStatus($status)
		{
			return Response::json(Server::ofStatus($status)->get());
		}
	}
?>