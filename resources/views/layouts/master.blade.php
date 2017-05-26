<!DOCTYPE html>
<html>
<head>
	<title>Robot - @yield('title')</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style type="text/css">
	.collection .collection-item.active{
		background-color: #f4511e !important;
		color: #ffffff !important;
	}
</style>
<body>
	@include('partials.flash')
	@include('partials.nav')

	<div class='container'>


		<div class='row'>
			<aside class='col s4'>

				@yield('sidebar')

			</aside>

			<main class='col s8'>

				@yield('content')

			</main>
		</div>



	</div>
	
	@include('partials.footer')

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
	<script>
		$(".button-collapse").sideNav();
	</script>
</body>
</html>