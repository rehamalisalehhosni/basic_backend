<?php
$locale = App::getLocale();
$setting = \App\Models\SettingTranslation::where(['locale'=>$locale,'setting_id'=>1])->first();
$ProjectsCategory = \App\Models\ProjectsCategoryTranslation::where(['locale'=>$locale])->where('parent','!=','0')->orderby('sort','asc')->get();
$ProjectsCategoryMain = \App\Models\ProjectsCategoryTranslation::where(['locale'=>$locale,'parent'=>'0'])->orderby('sort','asc')->get();

$social = \App\Models\SocialMedia::orderby('sort','asc')->get();
$footer= \App\Models\PagesTranslation::where('locale',$locale)->where('page','=','Footer')->get()->first();

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $setting->company_name?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="index, follow"/>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>

	<link rel="shortcut icon" href="images/favicon.ico">
	{{ Html::style('front/'.$setting->active_theme.'/css/reset.css')}}
	{{ Html::style('front/'.$setting->active_theme.'/css/plugins.css') }}
	{{ Html::style('front/'.$setting->active_theme.'/css/style.css') }}
	{{ Html::style('front/'.$setting->active_theme.'/css/color.css') }}
	@if(App::isLocale('ar'))
	{{ Html::style('front/'.$setting->active_theme.'/dist/css/bootstrap.rtl.min.css') }}
	@endif
	<?php if($setting->logo){ ?>
		<link rel="shortcut icon" href="{{url('/Uploads/setting/fav/'.$locale.'/'. $setting->fav)}}">
	<?php }?>

</head>
<body>
	<!--Loader -->
	<div class="loader2">
		<div class="loader loader_each"><span></span></div>
	</div>
	<!-- loader end  -->
	<!-- main start  -->
	<div id="main">
		<!-- header start  -->
		<!--<header class="main-header">-->
  <!--                  <a href="{{url('/')}}/{{$locale}}">-->
		<!--				<img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}" />-->
		<!--			</a>			<!-- sidebar-button -->-->
			<!-- nav-button-wrap-->
		<!--	<div class="nav-button-wrap">-->
		<!--		<div class="nav-button">-->
		<!--			<span  class="nos"></span>-->
		<!--			<span class="ncs"></span>-->
		<!--			<span class="nbs"></span>-->
		<!--			<div class="menu-button-text">@lang('front.Menu')</div>-->
		<!--		</div>-->
		<!--	</div>-->
			<!-- nav-button-wrap end-->
			<!-- sidebar-button end-->
			<!--  navigation -->
		<!--	<div class="header-contacts">-->
		<!--		<ul>-->
		<!--			<li><span>  @lang('front.Call')</span> <a href="tel:{{$setting->tel}}">{{$setting->tel}}</a></li>-->
		<!--			<li><span>  @lang('front.Write') </span> <a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>-->
		<!--		</ul>-->
		<!--	</div>-->
			<!-- navigation  end -->
		<!--</header>-->
		<!-- header end -->


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
					<div class="nav-button vis-m"><span></span><span></span><span></span>
					<div class="menu-button-text">Menu</div>
					</div>
				</div>
				<!-- mobile nav button end -->
				<!-- navigation  -->
				<div class="nav-holder">
					<nav>
						<ul>
							<li>
								<a href="{{route('index',App::getLocale())}}" class="ajax  {{ Request::segment(2) =='' ? 'act-link' : '' }}">@lang('front.home')</a>
								<!--second level -->
							</li>
							<li class='portofolio-link'>
								<a href="#" class=" {{ Request::segment(2) === 'projectCategory' ? 'act-link' : '' }}">@lang('front.Portfolio') </a>
								<!--second level -->
								<ul  class='has-sub'>
									@foreach($ProjectsCategoryMain as $item)
											<li>
												<a  class='ajax' href="{{route('portfolio.projectCategory',[App::getLocale(),'cat_id'=>$item->projects_category_id])}}">{{$item->title}}</a>
												<!--third level -->
												<ul class='has-sub'>
													@foreach($ProjectsCategory as $item_child)
														@if($item_child->parent==$item->projects_category_id)
													   	<li><a class='ajax'  href="{{route('portfolio.projectCategory',[App::getLocale(),'cat_id'=>$item_child->projects_category_id,'parent'=>$item->projects_category_id])}}">{{$item_child->title}}</a></li>
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
								<a href="{{route('aboutUs.index',App::getLocale())}} " class="ajax {{ Request::segment(2) === 'aboutUs' ? 'act-link' : '' }}">@lang('front.aboutUs') </a>
								<!-- Scroll navigation  -->
							</li>
							<li><a href="{{route('ourServices.index',App::getLocale())}}" class="ajax {{ Request::segment(2) === 'ourServices' ? 'act-link' : '' }}">@lang('front.services')</a></li>
							<li><a href="{{ route('contactUs.index',App::getLocale()) }}" class="ajax {{ Request::segment(2) === 'contactUs' ? 'act-link' : '' }}">@lang('front.contact')</a></li>

						</ul>
					</nav>
				</div>
				<!-- navigation  end -->
			</div>
			<!-- header-inner  end -->
			<!-- share button  -->
			<!-- share  end-->
		</header>



		<!-- left-panel -->
		<div class="left-panel">
			<div class="horizonral-subtitle"><span><strong></strong></span></div>
			<div class="left-panel_social">
				<ul >
					@foreach ($social as $item)
					<li><a href="{{$item->link}}" target="_blank" ><i class="fab fa-{{$item->icon}}"></i></a></li>
					@endforeach
				</ul>
			</div>
		</div>
		<!-- left-panel end -->
		<!-- share-button -->
		<!-- <div class="share-button showshare">
		<span>Share</span>
	</div> -->
	<!-- share-button end -->
	<!-- wrapper  -->
	<div id="wrapper">


		<!-- content-holder  -->
		<div class="content-holder" data-pagetitle="
				<?php if(Request::segment(2) =='') { ?> @lang('front.home')
				<?php }elseif(Request::segment(2) =='portfolio'){ ?>
					@lang('front.Portfolio')
				<?php  } elseif(Request::segment(2) =='aboutUs'){ ?>
					@lang('front.aboutUs')
				<?php } elseif(Request::segment(2) =='ourServices'){ ?>
				 	@lang('front.services')
		  	<?php } elseif(Request::segment(2) =='contactUs') { ?>
					@lang('front.contact')  <?php }  ?>
					">
			<!-- nav-holder-->
				<!--<div class="nav-holder">-->
				<!--	<nav>-->
				<!--		<ul>-->
				<!--			<li>-->
				<!--				<a href="{{route('index',App::getLocale())}}" class=" {{ Request::segment(2) =='' ? 'act-link' : '' }}">@lang('front.home')</a>-->
								<!--second level -->
				<!--			</li>-->
				<!--			<li>-->
				<!--				<a href="#" class="{{ Request::segment(2) === 'portfolio' ? 'act-link' : '' }}">@lang('front.Portfolio') </a>-->
								<!--second level -->
				<!--				<ul>-->
				<!--					@foreach($ProjectsCategoryMain as $item)-->
				<!--							<li>-->
				<!--								<a href="{{route('portfolio.index',[App::getLocale(),'cat_id'=>$item->projects_category_id])}}">{{$item->title}}</a>-->
												<!--third level -->
				<!--								<ul>-->
				<!--									@foreach($ProjectsCategory as $item_child)-->
				<!--										@if($item_child->parent==$item->projects_category_id)-->
				<!--									   	<li><a href="{{route('portfolio.index',[App::getLocale(),'cat_id'=>$item_child->projects_category_id,'parent'=>$item->projects_category_id])}}">{{$item_child->title}}</a></li>-->
				<!--										@endif-->
				<!--									@endforeach-->
				<!--								</ul>-->
												<!--third level end-->
				<!--							</li>-->
				<!--					@endforeach-->

				<!--				</ul>-->
								<!--second level end-->
				<!--			</li>-->
				<!--			<li>-->
				<!--				<a href="{{route('aboutUs.index',App::getLocale())}} " class="{{ Request::segment(2) === 'aboutUs' ? 'act-link' : '' }}">@lang('front.aboutUs') </a>-->
								<!-- Scroll navigation  -->
				<!--			</li>-->
				<!--			<li><a href="{{route('ourServices.index',App::getLocale())}}" class="{{ Request::segment(2) === 'ourServices' ? 'act-link' : '' }}">@lang('front.services')</a></li>-->
				<!--			<li><a href="{{ route('contactUs.index',App::getLocale()) }}" class="{{ Request::segment(2) === 'contactUs' ? 'act-link' : '' }}">@lang('front.contact')</a></li>-->

				<!--		</ul>-->
				<!--	</nav>-->
				<!--</div>-->

				<!--nav-social-->
				<div class="nav-social">
					<span class="nav-social_title">  @lang('front.Follow_us') : </span>
					<ul >
						@foreach ($social as $item)
						<li><a href="{{$item->link}}" target="_blank" ><i class="fab fa-{{$item->icon}}"></i></a></li>
						@endforeach
					</ul>
				</div>
				<!--nav-social end -->
			</div>
			<div class="nav-overlay">
				<div class="element"></div>
			</div>
			<!-- content-holder end -->
			@yield('content')


			<?php if(Request::segment(2) !='') {  ?>

				<div class="height-emulator fl-wrap"></div>
				<footer class="main-footer fixed-footer">
					<div class="pr-bg"></div>
					<div class="container">
						<div class="fl-wrap footer-inner">
							<div class="row">
								<div class="col-md-4">
									<div class="footer-logo">
										<a href="{{url('/')}}/{{$locale}}">
											<img src='{{url('/Uploads/setting/logo/'.$locale.'/'. $setting->logo)}}' alt="{{$setting->company_name}}" />
										</a>
									</div>
									<div class="footer_text  footer-box fl-wrap">
                      {!! $footer->description !!}
									</div>
								</div>
								<div class="col-md-4">
									<div class="footer-header fl-wrap"><span>01.</span> Contacts</div>
									<!-- footer-contacts-->
									<div class="footer-contacts footer-box fl-wrap">
										<ul>
											<li><span>@lang('front.Call'):</span><a href="tel:{{$setting->tel1}}">{{$setting->tel}}</a></li>
											<li><span>@lang('front.Write')  :</span><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
											<li><span>@lang('front.Find_us') : </span><a href="#">{{$setting->address}}</a></li>
										</ul>
									</div>
									<!-- footer contacts end -->
									<a href="{{ route('contactUs.index',App::getLocale()) }}" class="ajax fc_button">@lang('front.Get_In_Touch') <i class="fal fa-envelope"></i></a>
								</div>
								 <div class="col-md-4">
									<div class="footer-header fl-wrap"><span>02.</span> SUBSCRIBE</div>
									<div class="footer-box fl-wrap">
										<p>Want to be notified when we launch a new template or an udpate. Just sign up and we'll send you a notification by email.</p>
										<div class="subcribe-form fl-wrap">
											<form id="newsletter_form" class="fl-wrap" method='post'>
												<input class="enteremail" name="email" id="newsletter_email" placeholder="Your Email" spellcheck="false" type="text">
												<button type="submit" id="subscribe-button" class="subscribe-button">  @lang('front.Send')  <i class="fal fa-long-arrow-right"></i></button>
												<label for="subscribe-email" class="subscribe-message msg"></label>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="subfooter fl-wrap">
							<!-- policy-box-->
							<div class="policy-box">
								<span>&#169; {{$setting->company_name}}    @lang('front.Reserved'). </span>
							</div>
							<!-- policy-box end-->
							<a href="#" class="to-top-btn to-top">@lang('front.Back_to_top') <i class="fal fa-long-arrow-up"></i></a>
						</div>
					</div>
					<div class="footer-canvas">
						<div class="dots gallery__dots" data-dots=""></div>
					</div>
				</footer>
			<?php }  ?>
			<!-- footer  end -->




		</div>
	</div>
	<!-- wrapper end -->
</div>
<!-- Main end -->
<script>
		var lats =parseFloat("<?php echo $setting->lat ?>");
		var long=parseFloat("<?php echo $setting->long ?>");
		var title="{{$setting->company_name}}";
		var marker="{{url('/Uploads/setting/pin/'.$locale.'/'. $setting->pin)}}";
</script>

<!--=============== scripts  ===============-->
{{ Html::script('front/'.$setting->active_theme.'/js/jquery.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/plugins.js') }}
@if( Request::segment(2) === 'projectCategory' )
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/jquery.themepunch.tools.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/jquery.themepunch.revolution.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.actions.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.carousel.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.kenburn.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.layeranimation.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.migration.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.navigation.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.parallax.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.slideanims.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/revolution.extension.video.min.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/revolution/rev-slider-init.js') }}
@endif
{{ Html::script('front/'.$setting->active_theme.'/js/core.js') }}
{{ Html::script('front/'.$setting->active_theme.'/js/scripts.js') }}





<script>

    if(($('.no-footer').length>0))
      $(".content-footer , .height-emulator").hide();

     // Mobile bavigation   ------------------

    var nb = $(".nav-button"), nh = $(".nav-holder");
        nhw = $(".nav-holder"),
        nho = $(".nav-overlay");
    function showMenu() {
    	nb.removeClass("vis-m");
    	nh.slideDown(500);
    }
    function hideMenu() {
    	nb.addClass("vis-m");
    	nh.slideUp(500);
    	     nho.fadeIn(500);
        TweenMax.to(nhw, 0.6, {
            force3D: false,
            right: "0",
            ease: Expo.easeInOut
        });
        nhw.removeClass("but-hol");
    }

    nb.on("click", function() {
    	if ($(this).hasClass("vis-m")) showMenu(); else hideMenu();
    });
    var mobileHover = function () {
    $('.grid-item-holder , nav li').on('touchstart', function () {
        $(this).trigger('hover');
    }).on('touchend', function () {
        $(this).trigger('hover');
    });
    };

    mobileHover();
    var document_wdth=$(window).width();
     $(".nav-holder a.ajax").on("click", function() {

             setTimeout(function() {
                if(($('.no-footer').length>0))
                {
                  $(".content-footer , .height-emulator").hide();
                }
             },700);


            setTimeout(function(){
               if($('.gallery-filter-active').length>0){

            	$('.gallery-filter-active').click();
            }

            }, 2500);


           $('.nav-holder .act-link').removeClass('act-link');
           $(this).addClass('act-link');
           if($(this).parent().parent().hasClass('has-sub'))
            {

                 var text=$(this).text();
                setTimeout(function(){
                $( "a.gallery-filter:contains('"+text+"')" ).click();


                }, 3000);


                $('.portofolio-link>a').addClass('act-link')

            }
           if(document_wdth<1036){

               setTimeout(function(){
    	           hideMenu();
    	       }, 300);

           }

    });
</script>
<script>
      $(window).load(function() {
		    setTimeout(function(){
		       if($('.gallery-filter-active').length>0){

				$('.gallery-filter-active').click();
			}


		    }, 1000);

		});
  $( document ).ready(function() {

      $('#newsletter_form').submit(function(e){
          e.preventDefault();
          var _token = $('input[name="_token"]').val();
          let email =$('#newsletter_email').val();
          $.ajax({
              type:'POST',
              url:'{{ route('subscribe.add',App::getLocale()) }}',
              data:{'email':email,_token : _token },
              success:function(data){
                  console.log(data);
                  var output="";
                  if(data.status){
                      output+="<div class='text-success text-center'>";
                        output+=data.message;
                      output+="</div>";
                      $('#newsletter_email').val("");
                      $('.msg').html('');
                  }else{
                      output+="<div class='text-danger text-center'>";
                      for(var i=0;i<data.message.length;i++){
                          output+=data.message[i];
                      }
                      output+="</div>";
                  }
                  $('.msg').html(output);

              }
          });

      })
  });

  </script>
</body>
</html>
