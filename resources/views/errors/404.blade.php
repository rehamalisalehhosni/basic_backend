<?php $locale = App::getLocale();
$err= \App\Models\PagesTranslation::where('locale',$locale)->where('page','=','404')->get()->first();

 ?>
@extends('layouts.defaultPage')

@section('content')
<div class="content full-height">
	<!-- Hero section   -->
	<div class="hero-wrap">
		<!-- Hero image   -->
		<div class="bg"  data-bg="{{url('/Uploads/pages/'.$locale.'/'. $err->image)}}"></div>
		<!-- Hero image   end -->
		<div class="overlay"></div>
		<!-- Hero text   -->
		<div class="hero-wrap-item nFound-page-wrap">
			<span class="nFound-Page">404</span>
			<h2>  {!! $err->description !!} </h2>
			<a href="{{url('/')}}/{{$locale}}" class="hero-link">@lang('home')</a>
		</div>
		<!-- Hero text   end-->
	</div>
	<!-- Hero section   end -->
</div>

@endsection
