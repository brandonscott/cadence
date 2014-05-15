<?php
	class PrivilegeController extends BaseController {
		
		public function getAll()
		{
			return Response::json(Privilege::all());
		}

		public function store()
		{
			$privilege = new Privilege;
			$privilege->name = Input::get('name');

			$privilege->save();

			return Response::json($privilege);
		}

		public function deletePrivilege($id)
		{
			$privilege = Privilege::find($id);
			$privilege->delete();

            return Response::json(array("success" => true));
		}
	}
?>