<?php
	class PulseTest extends TestCase{

		public function testNewAdd()
		{
			$response = $this->call('POST', 'pulses', array("server_id" => 1, "ram_usage" => 500, "cpu_usage" => 500, "disk_usage" => 500, "uptime" => 500, "timestamp" => 500));
			$responseAsJson = json_decode($response->getContent());

			$this->assertEquals(500, $responseAsJson->cpu_usage);

			return $responseAsJson->id;
		}

		/**
		 * @depends testNewAdd
		 */
		public function testDelete($id)
		{
			$response = $this->call("DELETE", "pulses/$id");
			$responseAsJson = json_decode($response->getContent());
			$this->assertEquals(true, $responseAsJson->success);
		}
	}
?>