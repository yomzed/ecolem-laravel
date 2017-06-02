<header>
	
		<nav class='deep-orange darken-2'>
			@section('navigation')
			<div class="nav-wrapper">
				<div class='container'>
					<a href="/" class="brand-logo">Robot</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="/">Home</a></li>
						<li><a href="badges.html">Contact</a></li>
						@if(auth()->check())
    						<li>
   								 <a href="{{route('logout')}}">Sign Out</a>
    						</li>
    						<li>
   								<a href="{{route('dashboard')}}">Dashboard</a>
    						</li>
    					@else
   							<li>
    							<a href="{{route('login')}}">Login</a>
    						</li>
						@endif
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li><a href="/">Home</a></li>
						<li><a href="badges.html">Contact</a></li>
						<li><a href="collapsible.html">Login</a></li>
					</ul>
				</div>
			</div>
			@show
		</nav>

</header>