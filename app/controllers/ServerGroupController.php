<?php
	class ServerGroupController extends BaseController {
		
		public function getAll()
		{
			return Response::json(ServerGroup::all());
		}

		public function getServers($id)
		{
			$serverGroup = ServerGroup::find($id);
			return Response::json($serverGroup->server);
		}

		public function store()
		{
			$serverGroup = new ServerGroup;
			$serverGroup->name = Input::get("name");
			$serverGroup->save();

			return Response::json($serverGroup);
		}

        public function deleteServerGroup($id)
        {
            $serverGroup = ServerGroup::find($id);
            $serverGroup->delete();

            $servers = Server::where("servergroup_id", "=", $id)->get();

            foreach($servers as $server)
            {
            	$server->servergroup_id = 0;
            	$server->save();
            }

            return Response::json(array("success" => true));
        }

        public function getServerGroup($id)
		{
			return Response::json(ServerGroup::find($id));
		}
	}
?>