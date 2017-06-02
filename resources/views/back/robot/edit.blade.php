@extends('layouts.admin')

@section('title', 'New robot')

@section('content')
<style>
	/* label focus color */
   .input-field input[type='text']:focus + label, .input-field select:focus + label, textarea.materialize-textarea:focus:not([readonly]) + label {
     color: #e64a19;
   }
   /* label underline focus color */
   .input-field input[type='text']:focus, .input-field select:focus, textarea.materialize-textarea:focus:not([readonly]) {
     border-bottom: 1px solid #e64a19;
     box-shadow: 0 1px 0 0 #e64a19;
   }
   /* label focus color */
   .input-field input[type='number']:focus + label, .input-field select:focus + label, textarea.materialize-textarea:focus:not([readonly]) + label {
     color: #e64a19;
   }
   /* label underline focus color */
   .input-field input[type='number']:focus, .input-field select:focus, textarea.materialize-textarea:focus:not([readonly]) {
     border-bottom: 1px solid #e64a19;
     box-shadow: 0 1px 0 0 #e64a19;
   }

   .dropdown-content li>a, .dropdown-content li>span {
   		color: #e64a19;
   }
   [type="checkbox"]:checked+label:before {
   		border-right: 2px solid #e64a19;
   		border-bottom: 2px solid #e64a19;
   }
</style>
<section class='section deep-orange darken-2'>
	<div class='container' style="width: 85%">
		<h1 class="light header white-text">Edit robot: {{$robot->name}}</h1>
	</div>
</section>

<section class='section white'>
	<div class='container' style="width: 85%;">
	
	{{-- Affichage des erreurs --}}
	@if (count($errors) > 0)
		<div class="red-text text-darken-3">
				@foreach($errors->all() as $message)
					<b class="valign-wrapper">
						<i class="material-icons tiny">error</i>
						&nbsp;{{$message}}
					</b>
				@endforeach
		</div>
	@endif
		
		<form class="row" method="post" action="{{route('robot.update', $robot->id)}}" enctype="multipart/form-data">
			{{ method_field('PUT') }} {{-- Défini la méthode d'envoi --}}
			{{csrf_field()}} {{-- Token de protection formulaire CSRF (??) --}}
			<div class="col s6">
				<div class='input-field'>
					<input id="name" name="name" type="text" value="{{$robot->name}}">
					<label for="name">Name</label>
				</div>
				<div class='input-field'>
					<textarea id="description" name="description" class="materialize-textarea">{{$robot->description}}</textarea>
					<label for="description">Description</label>
				</div>
						@foreach($tags as $id => $name)
							<p style="display: inline-block">
								<input name="tags[]" type="checkbox"  id="t{{$id}}" value="{{$id}}" {{$robot->isTag($id) ? 'checked' : ''}}>
								<label for="t{{$id}}" style="padding-right: 30px; padding-left: 25px;">{{$name}}</label>
							</p>
						@endforeach

			</div>

			<div class="col s6">
				<div class='input-field'>
					<select id="category_id" name="category_id" class="materialSel">
						<option value="" selected>No category</option>

						@foreach($cats as $id => $title)
							<option value="{{$id}}"{{selected_fields($id, $robot->category_id, 'selected')}}>{{$title}}</option>
						@endforeach

					</select>
					<label>Choose a category</label>
				</div>
				<div class='input-field'>
					<select id="status" name="status" class="materialSel">
						<option value="published" @if ($robot->status === 'published') selected @endif>Published</option>
						<option value="unpublished" @if ($robot->status === 'unpublished') selected @endif>Unpublished</option>
						<option value="draft" @if ($robot->status === 'draft') selected @endif>Draft</option>
					</select>
					<label>Status</label>
				</div>
				<div class="input-field">
					<input name='power' type='number' value='{{$robot->power}}'>
					<label>Power</label>
				</div>
				<label>Image</label>
				<div class="file-field input-field">
					<div class="waves-effect waves-light btn deep-orange darken-2">
						<span>Upload</span>
						<input type="file" name="picture" accept="image/*">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" id="file_name" name="file_name" type="text" placeholder="Upload a picture for your robot" value="{{$robot->link}}">

						@if(!empty($robot->link))

							<a onclick="$('#file_name').val('')" class="pull-right deep-orange-text text-darken-2 valign-wrapper" style="cursor:pointer">
								Remove the image <i class="material-icons">close</i>
							</a>

						@endif

					</div>
				</div>
			</div>

			<div class='col s12 center-align'>
				<button type="submit" class="waves-effect waves-light btn deep-orange darken-2">
					Submit <i class="material-icons right">send</i>
				</button>
			</div>
			
		</form>

	</div>
</section>

@endsection