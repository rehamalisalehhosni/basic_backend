<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\Languages;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $slider= Slider::orderBy('slider_id','DESC')->paginate(20);
    return view('Backend/Slider.index',compact('slider'))
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
    return view('Backend/Slider.create',compact('languages'));

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function setDatMain($request,$lang)
  {
    $this->validate($request, [
      'title_'.$lang => 'required',
      'image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $slider = new Slider;
    $slider->title = $request->input('title_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/slider/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $slider->image = $fileName ;
    }

    $slider->save() ;
    return $slider;
  }
  public function setDataLanguage($request,$lang,$data)
  {
    $sliderTranslation = new SliderTranslation;
    $sliderTranslation->title = $request->input('title_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/slider/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $sliderTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $sliderTranslation->image=$fileName ;
      }
    }
    $sliderTranslation->slider_id=$data->slider_id;
    $sliderTranslation->locale=$lang;
    $sliderTranslation->save() ;
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
    return redirect()->route('slider.index')
    ->with('success','Slider created successfully');
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
    $item = Slider::find($id);
    return view('Backend/Slider.show',compact('item'));
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
    $item = Slider::find($id);
    return view('Backend/Slider.edit',compact('item','languages'));
  }
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function updateDatMain($request,$lang,$id){
    $this->validate($request, [
      'title_'.$lang => 'required',
      'image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $slider=Slider::find($id);
    $slider->title = $request->input('title_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/slider/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $slider->image = $fileName ;
    }

    $slider->update();
    return $slider;
  }
  public function updateDataLanguage($request,$lang,$data,$sliderId){
    $id=$request->input('slider_translations_id_'.$lang);
    $sliderTranslation = SliderTranslation::find($id);
    if($sliderTranslation){
      $exists=true;
      $sliderTranslation = SliderTranslation::find($id);
    }else{
      $exists=false;
      $sliderTranslation = new SliderTranslation;
    }//$id
    $sliderTranslation->title = $request->input('title_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/slider/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $sliderTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $sliderTranslation->image=$fileName ;
      }
    }
    if($exists){
      $sliderTranslation->update() ;
    }else{
      $sliderTranslation->locale=$lang ;
      $sliderTranslation->slider_id=$sliderId ;

      $sliderTranslation->save() ;
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
    return redirect()->route('slider.index')
    ->with('success','Slider updated successfully');

  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(Slider::find($id)){
      Slider::find($id)->delete();
      $affectedRows2 = SliderTranslation::where('slider_id', '=', $id)->delete();

    }
    return redirect()->route('slider.index')
    ->with('success','Slider deleted successfully');

  }
}
