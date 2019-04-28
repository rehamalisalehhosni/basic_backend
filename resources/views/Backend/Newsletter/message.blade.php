@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Send Message</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('newsletter.index') }}"> Back</a>
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

{!! Form::open(array('route' => 'newsletter.send','method'=>'POST','novalidate' => 'novalidate','files' => true)) !!}
<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Subject:</strong>
			{!! Form::text('subject', null, array('placeholder' => 'Subject','class' => 'form-control')) !!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Message:</strong>
			{!! Form::textarea('message', null, array('placeholder' => 'Message','class' => 'form-control tinymce','style'=>'height:100px')) !!}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
{!! Form::close() !!}
@endsection
