@extends('layouts.admin')

@section('title', 'List')

@section('content')

<section class='section deep-orange darken-2'>
	<div class='container' style="width: 85%">
		<h1 class="light header white-text">All robots</h1>
	</div>
</section>

<section class='section white'>
	<div class='container' style="width: 85%">
		<table class="centered highlight">

			<thead>
				<th>Name</th>
				<th>Status</th>
				<th>Category</th>
				<th>Tags</th>
				<th>Author</th>
				<th>Created</th>
				<th>Actions</th>
			</thead>
			
			<tbody>
				@foreach($robots as $robot)
					<tr>
						<td><b>{{$robot->name}}</b></td>
						<td><em>{{$robot->status}}</em></td>
						<td>@if ($robot->category) {{$robot->category->title}} @else No category @endif</td>
						<td>
							@forelse($robot->tags as $tag)
								{{$tag->name}}
								@if(!$loop->last)
								 / 
								 @endif
							@empty
								No tags
							@endforelse
						</td>
						<td>{{$robot->user->name}}</td>
						<td>{{$robot->created_at->diffForHumans()}}</td>
						<td>
							@can('update', $robot)
								<a class="green-text text-accent-3" href="{{route('robot.edit', $robot->id)}}"><i class="material-icons">edit</i></a>
								<form class="destroy" method="post" action="{{route('robot.destroy', $robot->id)}}" style="display: inline-block">
									<a class="red-text text-darken-1" style="cursor: pointer;"><i class="material-icons">clear</i></a>
									{{ method_field('DELETE') }} {{-- Défini la méthode d'envoi --}}
									{{csrf_field()}} {{-- Token de protection formulaire CSRF (??) --}}
								</form>
							@else
								<span class="grey-text">
									<i class="material-icons">edit</i>
									<i class="material-icons">clear</i>
								</span>
							@endcan
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
		<div class="center-align">
			{{$robots->links()}}
		</div>
	</div>
</section>



@endsection

@section('scripts')
	@parent
		<script>
			$('.modal').modal();

			$('form.destroy a').on('click', function(e) {
				e.preventDefault();
				
				$form = $(this).parent('form');
				$('#confirmMaterial').modal('open');

				$('#confirmModal').on('click', function() {
					$form.submit();
				});

			});
		</script>
@endsection