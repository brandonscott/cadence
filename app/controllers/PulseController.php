<?php
	class PulseController extends BaseController{
		
		public function getAll()
		{
			
			return Response::json(Pulse::all());
		}

		public function store()
		{
			$pulse = new Pulse;

			$pulse->server_id = Input::get("server_id");
			$pulse->ram_usage = Input::get("ram_usage");
			$pulse->cpu_usage = Input::get("cpu_usage");
			$pulse->disk_usage = Input::get("disk_usage");
			$pulse->uptime = Input::get("uptime");
			$pulse->timestamp = Input::get("timestamp");

			$pulse->save();

			$pubnub = App::make('pubnub');
			$pubnub->publish(array(
				'channel' => 'Cadence',
				'message' => json_decode($pulse)
			));

			return Response::json($pulse);

		}
	}
?>