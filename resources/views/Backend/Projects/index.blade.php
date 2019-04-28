@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Projects CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('projects.create') }}"> Create New Projects</a>
		</div>
	</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
	<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>sort</th>
		<th>Title</th>
		<th>Category</th>
		<th>Main Image</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($projects as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->sort }}</td>
		<td>{{ $item->title }}</td>
		<td>{{ $item->projectsCategory->title }}</td>
		<td><img src="{{url('/Uploads/projects/'.$languages->code.'/'. $item->main_image)}}" alt="" class="img-thumbnail img_view" /></td>
		<td>
			<a class="btn btn-info" href="{{ route('projects.show',$item->projects_id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('projects.edit',$item->projects_id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['projects.destroy', $item->projects_id],'style'=>'display:inline']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $projects->render() !!}
@endsection
