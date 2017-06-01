@extends('layouts.master')

@section('title', $cat->title)

@section('sidebar')
	<div class='collection with-header'>
		<li class='collection-header' style='list-style:none'><h4>Categories</h4></li>
		@foreach($cats as $category)
				<a class='collection-item deep-orange-text text-darken-2 {{Request::is(Request::segment(1).'/'.$category->id) ? 'active' : ''}}' href='/category/{{$category->id}}'>
					{{$category->title}}
					<span class='new badge deep-orange darken-2' data-badge-caption='bots'>{{$category->robots_count}}</span>
				</a>
		@endforeach
	</div>
@endsection

@section('content')
	<h3>
		Robots in category "{{ $cat->title }}"
	</h3>
	
	@foreach($cat->robots as $robot)
		
		<div class='card'>
			<div class='card-image waves-effect waves-block waves-light'>
				<a href='/robot/{{ $robot->id }}'>
					<img src='{{ url('img', $robot->link) }}'>
					<span class='card-title'>{{ $robot->name }}</span>
				</a>
			</div>
		</div>

	@endforeach
	

@endsection