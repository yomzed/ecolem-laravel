@extends('layouts.master')

@section('title', $tag->name)

@section('sidebar')
	<div class='collection with-header'>
		<li class='collection-header' style='list-style:none'><h4>Tags</h4></li>
		@foreach($tags as $uTag)
				<a class='collection-item deep-orange-text text-darken-2 {{Request::is(Request::segment(1).'/'.$uTag->id) ? 'active' : ''}}' href='/tag/{{$uTag->id}}'>
					{{$uTag->name}}
					<span class='new badge deep-orange darken-2' data-badge-caption='bots'>{{$uTag->robots_count}}</span>
				</a>
		@endforeach
	</div>
@endsection

@section('content')
	<h3>
		Robots with tag "{{ $tag->name }}"
	</h3>
	
	@foreach($tag->robots as $robot)
		
		<div class="col s12">
   			<div class="card horizontal">
      			<div class="card-image">
      				<a href="/robot/{{ $robot->id }}" class="waves-effect waves-light">
                @if(!empty($robot->link))
        				  <img src="{{ url('img', $robot->link) }}">
                @endif
        			</a>
      			</div>
      			<div class="card-stacked">
        			<div class="card-content">
        				<h5 class="header">{{ $robot->name }}</h5>
          				<p>{{ $robot->description }}</p>
        			</div>
        			<div class="card-action">
          				<a href="/robot/{{ $robot->id }}" class="btn-floating waves-effect waves-light red"><i class="material-icons">search</i></a>
        			</div>
      			</div>
    		</div>
  		</div>

	@endforeach
	

@endsection