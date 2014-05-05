# Laravel PubNub

This is a really light wrapper for the PubNub API.
It comes with a simple demo. You can delete controllers/, views/ and routes.php if not needed.

## Installation

#### Just register the bundle
	'pubnub' => array(
		'auto'    => true,
		// Want to use the demo?
		'handles' => 'pubnub',
	)

## Usage

1. Edit config/pubnub.php
2. Call PubNub using the IoC Resolver.

You can use use [any functionality provided by PubNub](https://pubnub-prod.appspot.com/tutorial/php-push-api).

#### Publish
	IoC::resolve('pubnub')->publish(array(
		'channel' => 'my_channel',
		'message' => array( 'my_var' => 'my text data' )
	));

#### Subscribe
	IoC::resolve('pubnub')->subscribe(array(
		'channel ' => 'my_channel',
		'callback' => function($message) {
			var_dump($message['my_var']); // print message
			return true;             // keep listening?
		}
	));

#### History
	$messages = IoC::resolve('pubnub')->history(array(
		'channel' => 'my_channel',
		'limit'   => 10
	));