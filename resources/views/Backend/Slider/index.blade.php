@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Slider CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('slider.create') }}"> Create New Slider</a>
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
	@foreach ($slider as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->title }}</td>
		<td><img src="{{url('/Uploads/slider/en/'. $item->image)}}" alt="" class="img-thumbnail img_view" /></td>
		<td>
			<a class="btn btn-info" href="{{ route('slider.show',$item->slider_id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('slider.edit',$item->slider_id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['slider.destroy', $item->slider_id],'style'=>'display:inline']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $slider->render() !!}
@endsection
