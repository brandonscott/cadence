<?php

require __DIR__.'/../libraries/pubnub-api/3.3/Pubnub.php';

IoC::singleton('pubnub', function()
{
	$publish_key   = Config::get('pubnub::pubnub.publish_key');
	$subscribe_key = Config::get('pubnub::pubnub.subscribe_key');
    
    return new Pubnub($publish_key, $subscribe_key);
});

?>