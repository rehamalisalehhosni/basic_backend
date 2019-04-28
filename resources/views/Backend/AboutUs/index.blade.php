@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>About Us CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('about.create') }}"> Create New About Us</a>
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
		<th>Sort</th>
		<th>Title</th>
		<th>Main Image</th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($about as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->sort }}</td>
		<td>{{ $item->title }}</td>
		<td><img src="{{url('/Uploads/aboutus/image/en/'. $item->image)}}" alt="" class="img-thumbnail img_view" /></td>
		<td>
			<a class="btn btn-info" href="{{ route('about.show',$item->aboutus_id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('about.edit',$item->aboutus_id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['about.destroy', $item->aboutus_id],'style'=>'display:inline']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $about->render() !!}
@endsection
