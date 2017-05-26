<!DOCTYPE html>
<html>
<head>
	<title>Robot - Login</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style type="text/css">
	html, body, .container {
		height: 100%;
	}
	/* label focus color */
   .input-field input[type=text]:focus + label {
     color: #e64a19;
   }
   /* label underline focus color */
   .input-field input[type=text]:focus {
     border-bottom: 1px solid #e64a19;
     box-shadow: 0 1px 0 0 #e64a19;
   }
   /* label focus color */
   .input-field input[type=password]:focus + label {
     color: #e64a19;
   }
   /* label underline focus color */
   .input-field input[type=password]:focus {
     border-bottom: 1px solid #e64a19;
     box-shadow: 0 1px 0 0 #e64a19;
   }
</style>
<body>
	@include('partials.flash')
	
	<div class='container valign-wrapper'>

		<div class="clearfix"></div>
		<form action="{{url('login')}}" method="POST" novalidate>
			
			{{csrf_field()}} {{-- Token de protection formulaire CSRF (??) --}}

			<div class="row">
				<h2 class="col s8 deep-orange-text text-darken-2">Connexion</h2>

				<div class="input-field col s8">
					<input id="email" type="text" name="email" class="validate @if($errors->has('email')) invalid @endif" value="{{old('email')? old('email') : ''}}">
					<label for="email">Email</label>
				</div>

				@if($errors->has('email')) <div class="col s8"><p>{{$errors->first('email')}}</p></div>@endif

				<div class="input-field col s8">
					<input id="password" type="password" name="password" class="validate @if($errors->has('password')) invalid @endif" value="{{old('password')? old('password') : ''}}">
					<label for="password">Password</label>
				</div>
				@if($errors->has('password')) <div class="col s8"><p>{{$errors->first('password')}}</p></div>@endif
	
				<div class="input-field col s8">
					
				</div>


				<div class="input-field col s8">
					<button class="btn waves-effect waves-light deep-orange darken-2" type="submit" name="action">Se connecter
						<i class="material-icons right">send</i>
					</button>
					<input {{old('remember')? 'checked' : ''}} id="rememberMe" type="checkbox" name="rememberMe" value="rememberMe" class="validate">
					<label for="rememberMe">Remember Me</label>
				</div>
			</div>
		</form>
		<div class="clearfix"></div>

	</div>


	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
</body>
</html>