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
			$server->description = Input::get("description");
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
			$server = Server::where('guid', '=', $guid)->update(array('online' => Input::get("status")));
			return Response::json(Server::where('guid', '=', $guid)->get());
		}

		public function updateServerDetails($guid)
		{
			$server = Server::where('guid', '=', $guid)->update(array(
				"available_disk" => Input::get("available_disk"),
				"available_ram" => Input::get("available_ram"),
				"cpu_speed" => Input::get("cpu_speed"),
				"os_name" => Input::get("os_name"),
				"os_version" => Input::get("os_version")
			));
			return Response::json(Server::where('guid', '=', $guid)->get());
		}
	}
?>