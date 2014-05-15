<?php
	class SubscriptionTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'subscriptions', array('servergroup_id' => 33, 'user_id' => 1, 'phonecall' => 1, 'text' => 1, 'push' => 1));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals(33, $responseAsJson->servergroup_id);

			return $responseAsJson->id;
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "subscriptions/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}
	}
?>