
@extends('layouts.defaultPage')

@section('content')
<div class="content full-height">
	<!-- Hero section   -->
	<div class="hero-wrap">
		<!-- Hero image   -->
		<div class="bg"  data-bg="images/bg/1.jpg"></div>
		<!-- Hero image   end -->
		<div class="overlay"></div>
		<!-- Hero text   -->
		<div class="hero-wrap-item nFound-page-wrap">
			<span class="nFound-Page">404</span>
			<h2>@lang('Page_not_found')</h2>
			<a href="{{url('/')}}/{{$locale}}" class="hero-link">@lang('Back_to_home_page')</a>
		</div>
		<!-- Hero text   end-->
	</div>
	<!-- Hero section   end -->
</div>

@endsection
