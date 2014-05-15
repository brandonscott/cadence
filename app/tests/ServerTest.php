<?php
	class ServerTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'servers', array('servergroup_id' => 0, 'name' => "Test Server", 'available_disk' => 500, 'available_ram' => 500, 'cpu_speed' => 500, 'os_name' => "Test OS", 'os_version'=> "Test Version", "guid" => "NEWGUID"));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals("Test Server", $responseAsJson->name);

			return $responseAsJson->id;
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "servers/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}
	}
?>