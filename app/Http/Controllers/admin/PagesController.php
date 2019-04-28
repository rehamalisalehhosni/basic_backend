<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\PagesTranslation;
use App\Models\Languages;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $pages= Pages::orderBy('pages_id','DESC')->paginate(20);
    return view('Backend/Pages.index',compact('pages'))
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
    return view('Backend/Pages.create',compact('languages'));

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
    $pages = new Pages;
    $pages->title = $request->input('title_'.$lang);
    $pages->description = $request->input('description_'.$lang);
    $pages->page = $request->input('page_'.$lang);
    $pages->video = $request->input('video_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/pages/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $pages->image = $fileName ;
    }

    $pages->save() ;
    return $pages;
  }
  public function setDataLanguage($request,$lang,$data)
  {
    $pagesTranslation = new PagesTranslation;
    $pagesTranslation->title = $request->input('title_'.$lang);
    $pagesTranslation->description = $request->input('description_'.$lang);
    $pagesTranslation->page = $request->input('page_'.$lang);
    $pagesTranslation->video = $request->input('video_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/pages/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $pagesTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $pagesTranslation->image=$fileName ;
      }
    }
    $pagesTranslation->pages_id=$data->pages_id;
    $pagesTranslation->locale=$lang;
    $pagesTranslation->save() ;
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
    return redirect()->route('pages.index')
    ->with('success','Pages created successfully');
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
    $item = Pages::find($id);
    return view('Backend/Pages.show',compact('item'));
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
    $item = Pages::find($id);
    return view('Backend/Pages.edit',compact('item','languages'));
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
    $pages=Pages::find($id);
    $pages->title = $request->input('title_'.$lang);
    $pages->description = $request->input('description_'.$lang);
    $pages->video = $request->input('video_'.$lang);
    $pages->page = $request->input('page_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/pages/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $pages->image = $fileName ;
    }

    $pages->update();
    return $pages;
  }
  public function updateDataLanguage($request,$lang,$data,$pagesId){
    $id=$request->input('pages_translations_id_'.$lang);
    $pagesTranslation = PagesTranslation::find($id);
    if($pagesTranslation){
      $exists=true;
      $pagesTranslation = PagesTranslation::find($id);
    }else{
      $exists=false;
      $pagesTranslation = new PagesTranslation;
    }//$id
    $pagesTranslation->title = $request->input('title_'.$lang);
    $pagesTranslation->description = $request->input('description_'.$lang);
    $pagesTranslation->page = $request->input('page_'.$lang);
    $pagesTranslation->video = $request->input('video_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/pages/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $pagesTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $pagesTranslation->image=$fileName ;
      }
    }
    if($exists){
      $pagesTranslation->update() ;
    }else{
      $pagesTranslation->locale=$lang ;
      $pagesTranslation->pages_id=$pagesId ;

      $pagesTranslation->save() ;
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
    return redirect()->route('pages.index')
    ->with('success','Pages updated successfully');

  }


  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(Pages::find($id)){
      Pages::find($id)->delete();
      $affectedRows2 = PagesTranslation::where('pages_id', '=', $id)->delete();

    }
    return redirect()->route('pages.index')
    ->with('success','Pages deleted successfully');

  }
}
