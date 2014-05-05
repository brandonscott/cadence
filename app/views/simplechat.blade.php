@layout('pubnub::layout')

@section('script')
	@parent
	<script src="http://cdn.pubnub.com/pubnub-3.1.min.js"></script>
	<script>
	$(document).ready(function() {
		$('#form').submit(function(event) {
			event.preventDefault(); 
			$.post('{{ URL::to_action('pubnub::simplechat@index') }}', $('#form').serialize());
			$('#form')[0].reset();
		});

		PUBNUB.subscribe({
			channel    : 'simplechat',
			restore    : false,
			callback   : function(response) {
				var style = '';
				if (response.user == '{{ Session::get('user') }}')
					var user = 'Me';
				else
					var user = response.user;
				$('#pubnub').before('<div class="well well-small">'+user+': '+response.text+'</div>');
			},
			disconnect : function() {
				PUBNUB.publish({
					channel : 'simplechat',
					message : {
						user: 'Message',
						text: '{{ Session::get('user') }} left.'
					}
				});
			},
			reconnect  : function() {},
			connect    : function() {
				PUBNUB.publish({
					channel : 'simplechat',
					message : {
						user: 'Message',
						text: '{{ Session::get('user') }} joined.'
					}
				});
			}
		});
	})();
	</script>
@endsection

@section('content')
	<div pub-key="{{ Config::get('pubnub::pubnub.publish_key') }}" sub-key="{{ Config::get('pubnub::pubnub.subscribe_key') }}" ssl="off" origin="pubsub.pubnub.com" id="pubnub"></div>
	<hr />
	<form id="form" class="form-inline">
		<div class="input-append">
			<input class="span4" name="text" size="16" type="text"><button class="btn" type="submit">Post!</button>
		</div>
	</form>
@endsection