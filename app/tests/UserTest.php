<?php
	class UserTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'users', array('privilege_id' => 3, 'password' => 'Test', 'email' => "testing@testing.com", 'first_name' => 'Test' , 'last_name' => 'Test', 'mobile_number' => '+447935928168'));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals(3, $responseAsJson->privilege_id);

			return $responseAsJson->id;
		}

		public function testExistingAdd()
		{
			$response = $this->call('POST', 'users', array('privilege_id' => 3, 'password' => 'Test', 'email' => "testing@testing.com", 'first_name' => 'Test' , 'last_name' => 'Test', 'mobile_number' => '+447935928168'));
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(false, $responseAsJson->success);
		}

		/**
		 * @depends testNewAdd
		 */
		public function testEdit($id)
		{
			$response = $this->call('PUT', "users/$id", array('email' => "testing@testing.com", 'first_name' => 'Test' , 'last_name' => 'Test', 'mobile_number' => '+447935928168'));
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals("testing@testing.com", $responseAsJson->email);
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "users/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}
	}
?>