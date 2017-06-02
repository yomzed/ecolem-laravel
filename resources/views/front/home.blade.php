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
		<div class='card-panel'>
			<div class="row valign-wrapper">
			<div class="col s2">
				<img class="circle reponsive-img light-blue darken-2" src="{{ url('img', $robot->link) }}" style="max-height: 100px">
				
			</div>
			<div class="col s9 offset-s1">
				
				
					<span class='card-title'>{{ $robot->name }}</span>
					<a href="/robot/{{ $robot->id }}" class="pull-right btn-floating waves-effect waves-light red"><i class="material-icons">search</i></a>
					<p>{{ $robot->description }}</p>
			</div>
			</div>
		</div>	
	@endforeach

	{{$robots->links()}}
@endsection