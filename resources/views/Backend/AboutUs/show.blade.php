@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2> Show About Us</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('about.index') }}"> Back</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Title:</strong>
			{{ $item->title }}
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<strong>Description:</strong>
			{{ $item->description }}
		</div>
	</div>
	@if ($item->image_big)
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="form-group">
			<img src="{{url('/Uploads/aboutus/image_big/'. $item->image_big)}}" alt="" class="img-thumbnail img_view" />
		</div>
	</div>
	@endif
</div>
@endsection
