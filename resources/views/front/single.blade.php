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
	
	<div class="row valign-wrapper">
		
		<div class="col s4">
			<img class='circle responsive-img light-blue darken-2' src='{{ url('img', $robot->link) }}'>
		</div>
		
		<div class="col s7 offset-s1">
			<p>
				{{ $robot->description }}
			</p>
		</div>

	</div>

	<b>Tags: </b>
	@foreach($robot->tags as $tag)
		<div class='chip'>
			<a href="/tag/{{ $tag->id }}">{{ $tag->name }}</a>
		</div>
	@endforeach
	

@endsection