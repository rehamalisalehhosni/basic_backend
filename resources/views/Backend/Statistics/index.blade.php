@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Statistics CRUD</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('statistics.create') }}"> Create New Statistics</a>
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
		<th>Number </th>
		<th width="280px">Action</th>
	</tr>
	@foreach ($statistics as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->title }}</td>
		<td>{{ $item->number }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('statistics.show',$item->statistics_id) }}">Show</a>
			<a class="btn btn-primary" href="{{ route('statistics.edit',$item->statistics_id) }}">Edit</a>
			{!! Form::open(['method' => 'DELETE','route' => ['statistics.destroy', $item->statistics_id],'style'=>'display:inline']) !!}
			{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
</table>
{!! $statistics->render() !!}
@endsection
