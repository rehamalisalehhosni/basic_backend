@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Create New Languages Media</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('languages.index') }}"> Back</a>
		</div>
	</div>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
{!! Form::open(array('route' => 'languages.store','method'=>'POST','novalidate' => 'novalidate','files' => true)) !!}
<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Title:</strong>
			{!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Code:</strong>
			{!! Form::text('code', null, array('placeholder' => 'Code','class' => 'form-control')) !!}
		</div>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group ">
			<strong>Sort:</strong>
			{!! Form::text('sort', null, array('placeholder' => 'Sort','class' => 'form-control  ')) !!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
{!! Form::close() !!}
@endsection
