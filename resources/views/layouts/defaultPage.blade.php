<!DOCTYPE HTML>
<html lang="en">
<?php
$locale = App::getLocale();
$setting = \App\Models\SettingTranslation::where(['locale'=>$locale,'setting_id'=>1])->first();
$ProjectsCategory = \App\Models\ProjectsCategoryTranslation::where(['locale'=>$locale])->where('parent','!=','0')->orderby('sort','asc')->get();
$ProjectsCategoryMain = \App\Models\ProjectsCategoryTranslation::where(['locale'=>$locale,'parent'=>'0'])->orderby('sort','asc')->get();

$social = \App\Models\SocialMedia::orderby('sort','asc')->get();
$footer= \App\Models\PagesTranslation::where('locale',$locale)->where('page','=','Footer')->get()->first();

?>
<head>
	<!--=============== basic  ===============-->
	<meta charset="UTF-8">
	<title><?php echo $setting->company_name?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow"/>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<!--=============== css  ===============-->
	{{ Html::style('front/'.$setting->active_theme.'/css/reset.css')}}
	{{ Html::style('front/'.$setting->active_theme.'/css/plugins.css') }}
	{{ Html::style('front/'.$setting->active_theme.'/css/style.css') }}
	@if(App::isLocale('ar'))
	{{ Html::style('front/'.$setting->active_theme.'/dist/css/bootstrap.rtl.min.css') }}
	@endif
	<!--=============== favicons ===============-->
	<?php if($setting->logo){ ?>
		<link rel="shortcut icon" href="{{url('/Uploads/setting/fav/'.$locale.'/'. $setting->fav)}}">
	<?php }?>

</head>
<body>
	<!-- loader -->
	<div class="loader">
		<div id="movingBallG">
			<div class="movingBallLineG"></div>
			<div id="movingBallG_1" class="movingBallG"></div>
		</div>
	</div>
	<!-- loader end -->
	<!--================= main start ================-->
	<div id="main">
		<!--=============== header ===============-->
		<header>
			<!-- header-inner  -->
			<div class="header-inner">
				<!-- header logo -->
				<div class="logo-holder">
					<a href="{{url('/')}}/{{$locale}}">
						<img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}" />
					</a>
				</div>
				<!-- header logo end -->
				<!-- mobile nav button -->
				<div class="nav-button-holder">
					<div class="nav-button vis-m"><span></span><span></span><span></span></div>
				</div>
				<!-- mobile nav button end -->
				<!-- navigation  -->
				<div class="nav-holder">
					<nav>
						<ul>
							<li>
								<a href="{{route('index',App::getLocale())}}" class=" {{ Request::segment(2) =='' ? 'act-link' : '' }}">@lang('front.home')</a>
								<!--second level -->
							</li>
							<li>
								<a href="#" class="{{ Request::segment(2) === 'portfolio' ? 'act-link' : '' }}">@lang('front.Portfolio') </a>
								<!--second level -->
								<ul>
									@foreach($ProjectsCategoryMain as $item)
											<li>
												<a href="{{route('portfolio.index',[App::getLocale(),'cat_id'=>$item->projects_category_id])}}">{{$item->title}}</a>
												<!--third level -->
												<ul>
													@foreach($ProjectsCategory as $item_child)
														@if($item_child->parent==$item->projects_category_id)
													   	<li><a href="{{route('portfolio.index',[App::getLocale(),'cat_id'=>$item_child->projects_category_id,'parent'=>$item->projects_category_id])}}">{{$item_child->title}}</a></li>
														@endif
													@endforeach
												</ul>
												<!--third level end-->
											</li>
									@endforeach

								</ul>
								<!--second level end-->
							</li>
							<li>
								<a href="{{route('aboutUs.index',App::getLocale())}} " class="{{ Request::segment(2) === 'aboutUs' ? 'act-link' : '' }}">@lang('front.aboutUs') </a>
								<!-- Scroll navigation  -->
							</li>
							<li><a href="{{route('ourServices.index',App::getLocale())}}" class="{{ Request::segment(2) === 'ourServices' ? 'act-link' : '' }}">@lang('front.services')</a></li>
							<li><a href="{{ route('contactUs.index',App::getLocale()) }}" class="{{ Request::segment(2) === 'contactUs' ? 'act-link' : '' }}">@lang('front.contact')</a></li>

						</ul>
					</nav>
				</div>
				<!-- navigation  end -->
			</div>
			<!-- header-inner  end -->
			<!-- share button  -->
			<!-- share  end-->
		</header>
		<!--=============== wrapper ===============-->
		<div id="wrapper">
			<div class="content-holder">
				@yield('content')


					<!-- content footer-->
					<div class="height-emulator"></div>
					<footer class="content-footer">
						<!--  container  -->
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<!-- Footer logo -->
									<div class="footer-item footer-logo">
										<a href="{{url('/')}}/{{$locale}}">
											<img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}" />
										</a>
										<div>
											{!! $footer->description !!}

										    <!--{!! $setting->description !!}-->
										 </div>
									</div>
									<!-- Footer logo end -->
								</div>
								<!-- Footer info -->
								<div class="col-md-2">
									<div class="footer-item">
										<h4 class="text-link">@lang('front.Call')</h4>
										<ul>
											<li><a href="tel:{{$setting->tel1}}">{{$setting->tel}}</a></li>
											<li><a href="tel:{{$setting->tel2}}">{{$setting->tel2}}</a></li>
										</ul>
									</div>
								</div>
								<!-- Footer info end-->
								<!-- Footer info -->
								<div class="col-md-2">
									<div class="footer-item">
										<h4 class="text-link"> @lang('front.Write')</h4>
										<ul>
											<li><a href="{$setting->website}}">{{$setting->website}}</a></li>
											<li><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
										</ul>
									</div>
								</div>
								<!-- Footer info-->
								<!-- Footer info end-->
								<div class="col-md-2">
									<div class="footer-item">
										<h4 class="text-link">@lang('front.Visit')</h4>
										<ul>
											<li><span>{{$setting->address}}</span></li>
											<li> <a href="{{ route('contactUs.index',App::getLocale()) }}" target="_blank">@lang('front.View_on_map')</a></li>
										</ul>
									</div>
								</div>
								<!-- Footer info end-->
							</div>
							<!-- Footer copyright -->
							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-6">
									<div class="footer-wrap">
										<span class="copyright">  &#169; {{$setting->company_name}}    @lang('front.Reserved')
										</span>
										<span class="to-top">To Top</span>
									</div>
								</div>
							</div>
							<!-- Footer copyright end -->
						</div>
						<!--  container  end -->
						<!-- Hover animation  -->
						<canvas class="particular"></canvas>
						<!-- Hover animation  end -->
					</footer>
					<!-- content footer end -->
					<!-- share  -->
					<!-- share end -->
			</div>
			<!-- wrapper end -->
			<!-- Fixed footer -->
			<footer class="fixed-footer">
				<div class="footer-social">
					<ul>
						@foreach ($social as $item)
						<li><a href="{{$item->link}}" target="_blank" ><i class="fa  fa-{{$item->icon}}"></i></a></li>
						@endforeach
					</ul>
				</div>
				<!-- Header  title -->
				<div class="footer-title">
					<h2><a  href="#"></a></h2>
				</div>
				<!-- Header  title  end-->
			</footer>
			<!-- Fixed footer end-->
		</div>
		<!-- Main end -->
		<!--=============== scripts  ===============-->
		<script>
		    var lats =parseFloat("<?php echo $setting->lat ?>");
		    var long=parseFloat("<?php echo $setting->long ?>");
		    var title="{{$setting->company_name}}";
		    var marker="{{url('/Uploads/setting/pin/'.$locale.'/'. $setting->pin)}}";
		</script>

		{{ Html::script('front/'.$setting->active_theme.'/js/jquery.min.js') }}
		{{ Html::script('front/'.$setting->active_theme.'/js/plugins.js') }}
		{{ Html::script('front/'.$setting->active_theme.'/js/scripts.js') }}
		{{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBSPcOuFWRs4qpUvtw4QgoLF2IDUr3Ihjo') }}
		{{ Html::script('front/'.$setting->active_theme.'/js/map.js') }}
		<script>
		$(window).load(function() {
		    setTimeout(function(){
		       if($('.gallery-filter_active').length>0){
				$('.gallery-filter_active').click();
			}


		    }, 1000);

		});
		</script>

	</body>
	</html>
