<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Languages;

class AboutController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
   public function index(Request $request)
   {
     //
     $about= AboutUs::orderBy('aboutus_id','DESC')->paginate(20);
     return view('Backend/AboutUs.index',compact('about'))
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
     return view('Backend/AboutUs.create',compact('languages'));

   }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
   public function setDataLanguage($request,$lang,$data)
   {

     $aboutTranslation = new AboutUsTranslation;
     $aboutTranslation->title=  $request->input('title_'.$lang);
     $aboutTranslation->sort = $request->input('sort_'.$lang);
     $aboutTranslation->video = $request->input('video_'.$lang);
     $aboutTranslation->description=  $request->input('description_'.$lang);
     if($file = $request->hasFile('image_'.$lang)) {
       $file = $request->file('image_'.$lang) ;
       $extension = $file->getClientOriginalExtension();
       $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
       $fileName = str_replace(' ', '', $fileName);
       //$fileName = $file->getClientOriginalName() ;
       $destinationPath = public_path().'/Uploads/aboutus/image/'.$lang ;
       if (!file_exists($destinationPath)) {
         mkdir($destinationPath, 0777, true);
       }
        $Languages=Languages::get()[0];
      if($lang==$Languages->code){
        $aboutTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $aboutTranslation->image=$fileName ;
      }
     }
     $aboutTranslation->aboutus_id=$data->aboutus_id;
     $aboutTranslation->locale=$lang;
     $aboutTranslation->save() ;
   }
   public function setDatMain($request,$lang)
   {
    $this->validate($request, [
      'title_'.$lang => 'required',
      'image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

     $about = new AboutUs;
     $about->title =  $request->input('title_'.$lang);
     $about->description =  $request->input('description_'.$lang);
     $about->video = $request->input('video_'.$lang);
     $about->sort = $request->input('sort_'.$lang);

     if($file = $request->hasFile('image_'.$lang)) {
       $file = $request->file('image_'.$lang) ;
       $extension = $file->getClientOriginalExtension();
       $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
       $fileName = str_replace(' ', '', $fileName);
       //$fileName = $file->getClientOriginalName() ;
       $destinationPath = public_path().'/Uploads/aboutus/image/'.$lang ;
       if (!file_exists($destinationPath)) {
         mkdir($destinationPath, 0777, true);
       }
         $file->move($destinationPath,$fileName);
       $about->image = $fileName ;
     }

     $about->save() ;
     return $about;
   }
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

     return redirect()->route('about.index')
     ->with('success','About Us created successfully');
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
    $item = AboutUs::find($id);
    return view('Backend/AboutUs.show',compact('item'));

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $item = AboutUs::find($id);
    $languages=Languages::all();
    return view('Backend/AboutUs.edit',compact('item','languages'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function updateDatMain($request,$lang,$id){
    $about=AboutUs::find($id);
    $about->title =  $request->input('title_'.$lang);
    $about->description =  $request->input('description_'.$lang);
    $about->sort = $request->input('sort_'.$lang);
    $about->video = $request->input('video_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/aboutus/image/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $about->image = $fileName ;
    }
    $about->update() ;
    return $about;
  }

  public function updateDataLanguage($request,$lang,$data,$aboutId){
    $id=$request->input('aboutus_translations_id_'.$lang);
    $aboutTranslation = AboutUsTranslation::find($id);
    if($aboutTranslation){
      $exists=true;
      $aboutTranslation = AboutUsTranslation::find($id);
    }else{
      $exists=false;
      //  $settingTranslation = SettingTranslation::find($id);
      $aboutTranslation = new AboutUsTranslation;
    }//$id
    $aboutTranslation->title=  $request->input('title_'.$lang);
    $aboutTranslation->description=  $request->input('description_'.$lang);
    $aboutTranslation->sort = $request->input('sort_'.$lang);
    $aboutTranslation->video = $request->input('video_'.$lang);
    if($file = $request->hasFile('image_'.$lang)) {
      $file = $request->file('image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/aboutus/image/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];
      if($lang==$Languages->code){
        $aboutTranslation->image=$data->image;
      }else{
        $file->move($destinationPath,$fileName);
        $aboutTranslation->image=$fileName ;
      }
    }

    if($exists){
      //      $settingTranslation = SettingTranslation::find($id);
      $aboutTranslation->update() ;
    }else{
      //  $settingTranslation = SettingTranslation::find($id);
      $aboutTranslation->locale=$lang ;
      $aboutTranslation->aboutus_id=$aboutId ;

      $aboutTranslation->save() ;
    }

  }

  public function update(Request $request, $id)
  {
    $Languages=Languages::get();
    foreach ($Languages as $key => $item) {
      if($key==0){
        $data=$this->updateDatMain($request,$item->code,$id);
      }
      $this->updateDataLanguage($request,$item->code,$data,$id);
      // code...
    }
    return redirect()->route('about.index')
    ->with('success','About updated successfully');


  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(AboutUs::find($id)){
      AboutUs::find($id)->delete();
      $affectedRows2 = AboutUsTranslation::where('aboutus_id', '=', $id)->delete();

    }
    return redirect()->route('about.index')
    ->with('success','About deleted successfully');

  }
}
