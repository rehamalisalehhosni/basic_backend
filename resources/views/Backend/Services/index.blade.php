@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Services CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('services.create') }}"> Create New Services</a>
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
		<th>Main Image</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($services as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->title }}</td>
		<td><img src="{{url('/Uploads/services/en/'. $item->image)}}" alt="" class="img-thumbnail img_view" /></td>
		<td>
			<a class="btn btn-info" href="{{ route('services.show',$item->services_id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('services.edit',$item->services_id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['services.destroy', $item->services_id],'style'=>'display:inline']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $services->render() !!}
@endsection
