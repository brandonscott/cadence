<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SimpleChat</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
		<style>
			body {
				padding-top: 30px;
			}
		</style>
		<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="container">

			<div class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="#">SimpleChat</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								@if (Session::has('user'))
									<li class="active"><a href="{{ URL::to_action('pubnub::simplechat@index') }}">Chat</a></li>
									<li><a href="{{ URL::to_action('pubnub::simplechat@logout') }}">Logout</a></li>
								@else
									<li class="active"><a href="{{ URL::to_action('pubnub::simplechat@login') }}">Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			@yield('content')
			
		</div>

		@section('script')
			<script src="http://twitter.github.com/bootstrap/assets/js/jquery.js"></script>
			<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-collapse.js"></script>
		@yield_section

	</body>
</html>
