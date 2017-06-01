@extends('layouts.master')

@section('title', $robot->name)

@section('sidebar')

	@parent
	<p>This happened to the sidebar</p>
	
@endsection


@section('content')
	<h3>
		{{ $robot->name }} - 
		<small>
			<a href="/category/{{ $robot->category->id }}">{{ $robot->category->title }}</a>
		</small>
	</h3>

	<div class='card'>
		<div class='card-image'>
			<img class='responsive-img' src='{{ url('img', $robot->link) }}'>
		</div>
	</div>

	<p>
		{{ $robot->description }}
	</p>
	
	<b>Tags: </b>
	@foreach($robot->tags as $tag)
		<div class='chip'>
			<a href="/tag/{{ $tag->id }}">{{ $tag->name }}</a>
		</div>
	@endforeach
	

@endsection