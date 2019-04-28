@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Social Media CRUD</h2>
		</div>
		<div class="pull-right">
			@can('social-create')
			<a class="btn btn-success" href="{{ route('socialMedia.create') }}"> Create New Social Media</a>
			@endcan
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
		<th>Title</th>
		<th> Link</th>
		<th> Icon</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($socialMedia as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->title }}</td>
		<td>{{ $item->link }}</td>
		<td>{{ $item->icon }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('socialMedia.show',$item->social_media_id	) }}">Show</a>
			@can('social-edit')
			<a class="btn btn-primary" href="{{ route('socialMedia.edit',$item->social_media_id	) }}">Edit</a>
			@endcan
			@can('social-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['socialMedia.destroy', $item->social_media_id	],'style'=>'display:inline']) !!}

			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			@endcan
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $socialMedia->render() !!}
@endsection
