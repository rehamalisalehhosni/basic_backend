@extends('layouts.defaultPage')
@section('content')
<?php $locale = App::getLocale();?>


<!-- Page title -->
<div class="dynamic-title">{{$projectsDetails->title}}</div>
<!-- Page title  end-->
<!-- content  -->
<div class="content">
    <section class="parallax-section">
        <div class="parallax-inner">
            <div class="bg" data-bg="{{url('/Uploads/projects/'.$locale.'/'. $projectsDetails->main_image)}}" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
            <div class="overlay"></div>
        </div>
        <div class="container">
            <div class="page-title">
                <div class="row">
                    <div class="col-md-6">
                        <h2> <strong> {{$projectsDetails->title}} </strong></h2>
                    </div>
                    <div class="col-md-6">
                        <ul class="creat-list">
                            <li><a href="{{route('index',App::getLocale())}}">@lang('front.home')</a></li>
                            <li><a href="{{route('portfolio.index',[$locale,'cat_id'=>$projectsDetails->projects_category_id,'parent'=>$catParent->parent])}}">{{$catParent->title}}</a></li>
                            <li><a href="portfolio-single5.html">{{$projectsDetails->title}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- content end -->
<div class="content">
    <section>
        <div class="container">
            <!--=============== portfolio holder ===============-->
            <div class="gallery-items   three-columns grid-small-pad lightgallery">
                <!-- 1 -->
                @foreach($projectsImages as $img)
                <div class="gallery-item">
                    <div class="grid-item-holder">
                        <div class="box-item">
                            <a data-src="{{url('/Uploads/projects/project_images/'.$img->image)}}" class="popup-image" data-sub-html="{{$projectsDetails->title}}">
                                <span class="overlay"></span>
                                <img  src="{{url('/Uploads/projects/project_images/'.$img->image)}}"   alt="">
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end gallery items -->
            <div class="custom-inner-holder">
                <!-- 1 -->
                <div class="custom-inner">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>  @lang('front.Project_details')</h3>
                        </div>
                        <div class="col-md-6">
                            {!! $projectsDetails->description !!}

                            <div class="content-nav">
                                <ul>
                                    @if($next)
                                    <li><a href="{{route('portfolio.details',[App::getLocale(),'pro_id'=>$next->projects_translations_id])}}" class=" text-link">@lang('front.next_project')</a></li>
                                    @endif
                                    @if($prev)
                                    <li><a href="{{route('portfolio.details',[App::getLocale(),'pro_id'=>$prev->projects_translations_id])}}" class=" text-link">@lang('front.prev_project')</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 1 -->
            </div>
            <!-- custom-link-holder  end -->
        </div>
    </section>
</div>

@endsection
