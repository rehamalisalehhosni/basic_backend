<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Statistics;
use App\Models\StatisticsTranslation;
use App\Models\Languages;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {

    $statistics= Statistics::orderBy('statistics_id','DESC')->paginate(20);
    return view('Backend/Statistics.index',compact('statistics'))
    ->with('i', ($request->input('page', 1) - 1) * 20);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {

    $languages=Languages::all();
    return view('Backend/Statistics.create',compact('languages'));

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function setDatMain($request,$lang)
  {
    $statistics = new Statistics;
    $statistics->title = $request->input('title_'.$lang);
    $statistics->number = $request->input('number_'.$lang);
    $statistics->sort = $request->input('sort_'.$lang);
    $request->description=str_replace('../', url('/'), $request->input('description_'.$lang));
    $statistics->description = $request->description;
    $statistics->save() ;
    return $statistics;
  }
  public function setDataLanguage($request,$lang,$data)
  {
    $statisticsTranslation = new StatisticsTranslation;
    $statisticsTranslation->title = $request->input('title_'.$lang);
    $statisticsTranslation->number = $request->input('number_'.$lang);
    $statisticsTranslation->sort = $request->input('sort_'.$lang);
    $request->description=str_replace('../', url('/'), $request->input('description_'.$lang));
    $statisticsTranslation->description = $request->description;


    $statisticsTranslation->statistics_id=$data->statistics_id;
    $statisticsTranslation->locale=$lang;
    $statisticsTranslation->save() ;
  }


  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $Languages=Languages::get();
    foreach ($Languages as $key => $item) {
      if($key==0){
        $data=$this->setDatMain($request,$item->code);
      }
      $this->setDataLanguage($request,$item->code,$data);
      // code...
    }
    return redirect()->route('statistics.index')
    ->with('success','Statistics created successfully');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
    $item = Statistics::find($id);
    return view('Backend/Statistics.show',compact('item'));
  }
  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $languages=Languages::all();
    $item = Statistics::find($id);
    return view('Backend/Statistics.edit',compact('item','languages'));
  }
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function updateDatMain($request,$lang,$id){
    $statistics=Statistics::find($id);
    $statistics->title = $request->input('title_'.$lang);
    $statistics->number = $request->input('number_'.$lang);
    $statistics->sort = $request->input('sort_'.$lang);
    $request->description=str_replace('../', url('/'), $request->input('description_'.$lang));
    $statistics->description = $request->description;


    $statistics->update();
    return $statistics;
  }
  public function updateDataLanguage($request,$lang,$data,$statisticsId){
    $id=$request->input('statistics_translations_id_'.$lang);
    $statisticsTranslation = StatisticsTranslation::find($id);
    if($statisticsTranslation){
      $exists=true;
      $statisticsTranslation = StatisticsTranslation::find($id);
    }else{
      $exists=false;
      $statisticsTranslation = new StatisticsTranslation;
    }//$id
    $statisticsTranslation->title = $request->input('title_'.$lang);
    $statisticsTranslation->number = $request->input('number_'.$lang);
    $statisticsTranslation->sort = $request->input('sort_'.$lang);
    $request->description=str_replace('../', url('/'), $request->input('description_'.$lang));
    $statisticsTranslation->description = $request->description;


    if($exists){
      $statisticsTranslation->update() ;
    }else{
      $statisticsTranslation->locale=$lang ;
      $statisticsTranslation->statisticsId=$statisticsId ;

      $statisticsTranslation->save() ;
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
    $Languages=Languages::get();
    foreach ($Languages as $key => $item) {
      if($key==0){
        $data=$this->updateDatMain($request,$item->code,$id);
      }
      $this->updateDataLanguage($request,$item->code,$data,$id);
      // code...
    }
    return redirect()->route('statistics.index')
    ->with('success','Statistics updated successfully');

  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(Statistics::find($id)){
      Statistics::find($id)->delete();
      $affectedRows2 = StatisticsTranslation::where('statistics_id', '=', $id)->delete();

    }
    return redirect()->route('statistics.index')
    ->with('success','Statistics deleted successfully');

  }
}
