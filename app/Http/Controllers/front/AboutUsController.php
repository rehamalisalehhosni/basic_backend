<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Mail;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Models\PagesTranslation;
use App\Models\SettingTranslation;
use App\Models\StatisticsTranslation;


class AboutUsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','About Us')->get();

    $aboutUs= AboutUsTranslation::where('locale',$locale)->orderBy('sort','ASC')->get();
    $setting= SettingTranslation::where('locale',$locale)->first();
    $statisticData= StatisticsTranslation::where('locale',$locale)->get();

    return view('Front/'.$setting->active_theme.'/AboutUs.index',compact('aboutUs','banner','statisticData'));

  }


}
