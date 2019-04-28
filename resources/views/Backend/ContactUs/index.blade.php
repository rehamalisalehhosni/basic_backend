@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Contactus Request </h2>
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
		<th>name</th>
		<th>email</th>
		<th>Phone</th>
		<th>message</th>
	</tr>
	@foreach ($contactUs as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->name }}</td>
		<td>{{ $item->email }}</td>
		<td>{{ $item->phone }}</td>
		<td>{{ $item->message }}</td>

	</tr>
	@endforeach
</table>
{!! $contactUs->render() !!}
@endsection
