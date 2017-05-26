<!DOCTYPE html>
<html>
<head>
	<title>Robot Factory - @yield('title')</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style type="text/css">
	.collection .collection-item.active{
		background-color: #f4511e !important;
		color: #ffffff !important;
	}
	body {
		font-family: 'Ubuntu';
	}
</style>
<body>

	<header>
		<ul class="side-nav fixed" style="width: 300px;">
			<li class="logo center-align">
				<h4 class="deep-orange-text text-darken-2">Robot Factory</h4>
				<p>Hello {{$user->name}} :)</p>
			</li>
			<li class="bold {{Request::is('dashboard') ? 'active' : ''}}">
				<a class="waves-effect" href="{{route('dashboard')}}">Home <i class="material-icons">home</i></a>
			</li>
			
			<li class="bold {{Request::is('admin/robot/create') ? 'active' : ''}}">
				<a class="waves-effect" href="{{url('admin/robot/create')}}">New robot <i class="material-icons">add_box</i></a>
			</li>

			<li class="bold {{Request::is('admin/robot') ? 'active' : ''}}">
				<a class="waves-effect" href="{{url('admin/robot')}}">Manage robots <i class="material-icons">build</i></a>
			</li>
			
			<span style="display: block; position: absolute; bottom: 70px;">
				<li>
   					<a href="{{route('logout')}}">Sign Out <i class="material-icons">power_settings_new</i></a>
    			</li>

				<li class="bold">
					<a class="waves-effect" href="/">Return to front<i class="material-icons">replay</i></a>
				</li>
			</span>
		</ul>

	</header>
	
	<main style="padding-left: 300px;">
		@include('partials.flash')
		@yield('content')
	</main>

	<!-- Modal Structure -->
	<div id="confirmMaterial" class="modal bottom-sheet">
		<div class="modal-content">
			<h4>Do you want to destroy this bot?</h4>
			<p>This action is unreversible</p>
		</div>
		<div class="modal-footer">
			<a style="cursor: pointer;" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
			<a style="cursor: pointer;" id="confirmModal" class="waves-effect red darken-1 white-text btn-flat">Yes</a>
		</div>
	</div>

	@section('scripts')
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.materialSel').material_select();
			});
		</script>
	@show
</body>
</html>