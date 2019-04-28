<?php

namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\SettingTranslation;
use App\Models\AboutUsTranslation;
use App\Models\PagesTranslation;
use App\Models\StatisticsTranslation;
use App\Models\ProjectsTranslation;
use App;



class HomeController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $slider= SliderTranslation::where('locale',$locale)->orderBy('slider_id','Desc')->get();
    $aboutus= AboutUsTranslation::where('locale',$locale)->where('aboutus_id','=','1')->get();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','Home Page')->get();
    $statistic= PagesTranslation::where('locale',$locale)->where('page','=','Statistic')->first();
    $statisticData= StatisticsTranslation::where('locale',$locale)->get();
    $ProjectsTranslation= ProjectsTranslation::where('locale',$locale)->where('show_home','1')->get();
    $setting= SettingTranslation::where('locale',$locale)->first();
    return view('Front/'.$setting->active_theme.'/Home.index',compact('slider','aboutus','banner','statistic','statisticData','ProjectsTranslation'));
  }


}
