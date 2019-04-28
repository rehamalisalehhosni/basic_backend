<?php

namespace App\Http\Controllers\front;
use App;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\ServicesTranslation;
use App\Models\PagesTranslation;
use App\Models\SettingTranslation;



class OurServicesController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','Services')->get();

    $services= ServicesTranslation::where('locale',$locale)->orderBy('sort','ASC')->get();
    $setting= SettingTranslation::where('locale',$locale)->first();
    return view('Front/'.$setting->active_theme.'/OurServices.index',compact('services','banner'));
  }


}
