<?php
	class ServerGroupTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'servergroups', array('name' => "Test ServerGroup"));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals("Test ServerGroup", $responseAsJson->name);

			return $responseAsJson->id;
		}

		public function testExistingAdd()
		{
			$response = $this->call('POST', 'servergroups', array('name' => "Test ServerGroup"));
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(false, $responseAsJson->success);
		}

		/**
		 * @depends testNewAdd
		 */
		public function testEdit($id)
		{
			$response = $this->call("PUT", "servergroups/$id", array('name' => 'Test ServerGroupEdit'));
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals("Test ServerGroupEdit", $responseAsJson->name);
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "servergroups/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}


	}
?>