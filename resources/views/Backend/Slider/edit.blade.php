@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2>Edit New Slider</h2>
		</div>
		<div class="pull-right">
			<a class="btn btn-primary" href="{{ route('slider.index') }}"> Back</a>
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
{!! Form::model($item, ['method' => 'PATCH','novalidate' => 'novalidate','files' => true,'route' => ['slider.update', $item->slider_id]]) !!}
<div class="row">

	<ul class="nav nav-tabs">
		@foreach($languages as $key=>$lang)
			 <li class=" @if($key==0)   active  @endif"><a data-toggle="tab" href="#{{$lang->code}}">{{$lang->title}}</a></li>
		<!-- <li><a data-toggle="tab" href="#ar">Ar</a></li> -->
		@endforeach
	</ul>

	<div class="tab-content">

		@foreach($languages as $key=>$lang)

		<div id="{{$lang->code}}" class="tab-pane fade  @if($key==0)  in active  @endif ">
			@include('Backend.Slider.form', array('locale' => $lang->code,'data'=>$item->translations( $lang->code,$item->slider_id)))
		</div>
		@endforeach


	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
{!! Form::close() !!}
@endsection
