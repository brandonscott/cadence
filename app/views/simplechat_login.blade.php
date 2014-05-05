@layout('pubnub::layout')

@section('content')
	<form href="{{ URL::to_action('pubnub::simplechat@login') }}" method="post" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="user">User</label>
			<div class="controls">
				<input type="text" name="user" id="user" placeholder="Name">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn">Log in</button>
			</div>
		</div>
	</form>
@endsection