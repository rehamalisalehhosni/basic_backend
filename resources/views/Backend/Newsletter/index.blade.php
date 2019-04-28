@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Newsletter Request </h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-success" href="{{ route('newsletter.message') }}"> Send Message</a>
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
		<th>email</th>
	</tr>
	@foreach ($newsletter as $key => $item)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $item->email }}</td>

	</tr>
	@endforeach
</table>
{!! $newsletter->render() !!}
@endsection
