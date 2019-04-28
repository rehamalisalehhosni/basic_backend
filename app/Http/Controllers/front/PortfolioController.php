<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Mail;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProjectsCategory;
use App\Models\ProjectsCategoryTranslation;
use App\Models\PagesTranslation;
use App\Models\ProjectsImages;
use App\Models\ProjectsPlans;
use App\Models\ProjectsTranslation;
use App\Models\SettingTranslation;


class PortfolioController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','Project')->get();
    if(isset($request['parent'])){
      $mainId=(int)$request['parent'];
      $filter_id=$request['cat_id'];
    }else{
      $mainId=(int)$request['cat_id'];
      $filter_id=0;
    }
    $maincat= ProjectsCategoryTranslation::where('locale',$locale)->where('projects_category_id','=',$mainId)->first(); //mainId
    if($maincat){
      $subCat= ProjectsCategoryTranslation::where('locale',$locale)->where('parent','=',$maincat->projects_category_id)->get(); //mainId
      // $catParent= ProjectsCategoryTranslation::where('locale',$locale)->where('projects_category_id','=',(int)$request['parent'])->first();
      $ids=[];
      foreach ($subCat as $key => $it) {
        // code...
        $ids[]=$it->projects_category_id;
      }
      $projects= ProjectsTranslation::where('locale',$locale)->whereIn('projects_category_id',$ids)->where('publish','1')->orderby('sort','asc')->get();
    }
    // if($catParent->theme=='1'){urban
    // if($catParent->theme=='2')planning
    // if($catParent->theme=='3')Architecture
    $setting= SettingTranslation::where('locale',$locale)->first();

    return view('Front/'.$setting->active_theme.'/Portfolio.index',compact('maincat','subCat','banner','filter_id','projects'));
  }

  public function projectCategory(Request $request)
  {
    $locale = App::getLocale();
    if(isset($request['parent'])){
      $mainId=(int)$request['parent'];
      $filter_id=$request['cat_id'];
    }else{
      $mainId=(int)$request['cat_id'];
      $filter_id=0;
    }

    $maincat= ProjectsCategoryTranslation::where('locale',$locale)->where('projects_category_id','=',$mainId)->first(); //mainId
    if($maincat){
      $subCat= ProjectsCategoryTranslation::where('locale',$locale)->where('parent','=',$maincat->projects_category_id)->get(); //mainId
      // $catParent= ProjectsCategoryTranslation::where('locale',$locale)->where('projects_category_id','=',(int)$request['parent'])->first();
      $ids=[];
      foreach ($subCat as $key => $it) {
        // code...
        $ids[]=$it->projects_category_id;
      }
      $projects= ProjectsTranslation::where('locale',$locale)->whereIn('projects_category_id',$ids)->where('publish','1')->where('gallary','1')->orderby('sort','asc')->get();
    }
    $setting= SettingTranslation::where('locale',$locale)->first();

    return view('Front/'.$setting->active_theme.'/Portfolio.projectCategory',compact('maincat','subCat','filter_id','projects'));
  }


  public function details(Request $request)
  {
    $locale = App::getLocale();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','Project details')->first();

    $projectsDetails = ProjectsTranslation::find((int)$request['pro_id']);
    $catParent= ProjectsCategoryTranslation::where('locale',$locale)->where('projects_category_id','=',(int)$projectsDetails->projects_category_id)->first();
    $next= ProjectsTranslation::where('locale',$locale)->where('projects_category_id','=',(int)$projectsDetails->projects_category_id)->where('projects_translations_id','>',$projectsDetails->projects_translations_id)->get()->first();
    $prev= ProjectsTranslation::where('locale',$locale)->where('projects_category_id','=',(int)$projectsDetails->projects_category_id)->where('projects_translations_id','<',$projectsDetails->projects_translations_id)->get()->first();
    if(!$projectsDetails||!$projectsDetails->publish){
      return redirect('/');
    }
    $projectsImages = ProjectsImages::where('projects_translation_id',(int)$request['pro_id'])->get();
    $projectsPlans = ProjectsPlans::where('projects_translation_id',(int)$request['pro_id'])->get();
    $setting= SettingTranslation::where('locale',$locale)->first();

    return view('Front/'.$setting->active_theme.'/Portfolio.details',compact('projectsDetails','banner','projectsImages','projectsPlans','catParent','next','prev'));
  }
}
