@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Languages CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('languages.create') }}"> Create New Languages</a>
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
		<th> Code</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($languages as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->title }}</td>
		<td>{{ $item->code }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('languages.show',$item->languages_id	) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('languages.edit',$item->languages_id	) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['languages.destroy', $item->languages_id	],'style'=>'display:inline']) !!}

			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $languages->render() !!}
@endsection
