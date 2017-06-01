@extends('layouts.master')

@section('title', 'Home')

@section('sidebar')
	<div class='collection with-header'>
		<li class='collection-header' style='list-style:none'><h4>Categories</h4></li>

		@foreach($cat as $category)
				<a class='collection-item deep-orange-text text-darken-2 {{Request::is('/category/'.$category->id) ? 'active' : null}}' href='category/{{$category->id}}'>
					{{$category->title}} 
					<span class='new badge deep-orange darken-2' data-badge-caption='bots'>{{$category->robots_count}}</span>
				</a>
		@endforeach
	</div>
@endsection


@section('content')
@inject('stats', 'App\Services\StatRobot')

	<h3>Liste des robots <small><em>{{ $stats->count() }} publiés</em></small></h3>
	{{$robots->links()}}
	
	@foreach($robots as $robot)
		<div class='card'>
			<div class="card-image">
				<img class="activator" src="{{ url('img', $robot->link) }}">
				<span class='card-title'>{{ $robot->name }}</span>
				<a href="/robot/{{ $robot->id }}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">search</i></a>
			</div>
			<div class="card-content">
				<p>{{ $robot->description }}</p>
			</div>
		</div>	
	@endforeach

	{{$robots->links()}}
@endsection