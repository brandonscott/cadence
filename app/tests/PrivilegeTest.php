<?php
	class PrivilegeTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'privileges', array("name" => "TestPrivilege"));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals("TestPrivilege", $responseAsJson->name);

			return $responseAsJson->id;
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "privileges/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}
	}
?>