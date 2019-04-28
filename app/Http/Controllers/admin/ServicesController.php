<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\ServicesTranslation;
use App\Models\Languages;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $services= Services::orderBy('services_id','DESC')->paginate(20);
    return view('Backend/Services.index',compact('services'))
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
    return view('Backend/Services.create',compact('languages'));

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
      'description_'.$lang => 'required',
      'image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $services = new Services;
    $services->title = $request->input('title_'.$lang);
    $services->description =  $request->input('description_'.$lang);
    $services->sort =  $request->input('sort_'.$lang);

    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/services/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $services->image = $fileName ;
    }

    $services->save() ;
    return $services;
  }
  public function setDataLanguage($request,$lang,$data)
  {
    $servicesTranslation = new ServicesTranslation;
    $servicesTranslation->title = $request->input('title_'.$lang);
    $servicesTranslation->description =  $request->input('description_'.$lang);
    $servicesTranslation->sort =  $request->input('sort_'.$lang);

    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/services/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $servicesTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $servicesTranslation->image=$fileName ;
      }
    }
    $servicesTranslation->services_id=$data->services_id;
    $servicesTranslation->locale=$lang;
    $servicesTranslation->save() ;
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
    return redirect()->route('services.index')
    ->with('success','Services created successfully');
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
    $item = Services::find($id);
    return view('Backend/Services.show',compact('item'));
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
    $item = Services::find($id);
    return view('Backend/Services.edit',compact('item','languages'));
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
      'description_'.$lang => 'required',
      'image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $services=Services::find($id);
    $services->title = $request->input('title_'.$lang);
    $services->description =  $request->input('description_'.$lang);
    $services->sort =  $request->input('sort_'.$lang);

    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/services/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $services->image = $fileName ;
    }

    $services->update();
    return $services;
  }
  public function updateDataLanguage($request,$lang,$data,$servicesId){
    $id=$request->input('services_translations_id_'.$lang);
    $servicesTranslation = ServicesTranslation::find($id);
    if($servicesTranslation){
      $exists=true;
      $servicesTranslation = ServicesTranslation::find($id);
    }else{
      $exists=false;
      $servicesTranslation = new ServicesTranslation;
    }//$id
    $servicesTranslation->title = $request->input('title_'.$lang);
    $servicesTranslation->description =  $request->input('description_'.$lang);
    $servicesTranslation->sort =  $request->input('sort_'.$lang);

    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/services/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $servicesTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $servicesTranslation->image=$fileName ;
      }
    }
    if($exists){
      $servicesTranslation->update() ;
    }else{
      $servicesTranslation->locale=$lang ;
      $servicesTranslation->services_id=$servicesId ;

      $servicesTranslation->save() ;
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
    return redirect()->route('services.index')
    ->with('success','Services updated successfully');

  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(Services::find($id)){
      Services::find($id)->delete();
      $affectedRows2 = ServicesTranslation::where('services_id', '=', $id)->delete();

    }
    return redirect()->route('services.index')
    ->with('success','Services deleted successfully');

  }
}
