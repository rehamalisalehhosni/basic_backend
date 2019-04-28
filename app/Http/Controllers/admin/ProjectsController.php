<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\ProjectsImages;
use App\Models\ProjectsPlans;
use App\Models\ProjectsCategory;
use App\Models\ProjectsTranslation;
use App\Models\Languages;

use Validator;

class ProjectsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $languages=Languages::all()[0];

    $projects = Projects::orderBy('projects_id','DESC')->paginate(20);
    return view('Backend/Projects.index',compact('projects','languages'))
    ->with('i', ($request->input('page', 1) - 1) * 20);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $projectsCategory= ProjectsCategory::where('parent','!=','0')->lists('title','projects_category_id');
    $languages=Languages::all();
    return view('Backend/Projects.create',compact('projectsCategory','languages'));

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
      'projects_category_id_'.$lang => 'required',
      'description_'.$lang => 'required',
      'main_image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $projects = new Projects;
    $projects->show_home =  $request->input('show_home_'.$lang);
    $projects->publish =  $request->input('publish_'.$lang);
    $projects->sort = $request->input('sort_'.$lang);
    $projects->projects_category_id =  $request->input('projects_category_id_'.$lang);
    $projects->title = $request->input('title_'.$lang);
    $projects->gallary = $request->input('gallary_'.$lang);
    $projects->description =  $request->input('description_'.$lang);
    if($file = $request->hasFile('main_image_'.$lang)) {
      $file = $request->file('main_image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/projects/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $projects->main_image = $fileName ;
    }
    $projects->save() ;

    return $projects;
  }
  public function setDataLanguage($request,$lang,$data)
  {
    $projectsTranslation = new ProjectsTranslation;
    $projectsTranslation->title = $request->input('title_'.$lang);

    $projectsTranslation->show_home =  $request->input('show_home_'.$lang);
    $projectsTranslation->publish =  $request->input('publish_'.$lang);
    $projectsTranslation->sort = $request->input('sort_'.$lang);
    $projectsTranslation->projects_category_id =  $request->input('projects_category_id_'.$lang);
    $projectsTranslation->description =  $request->input('description_'.$lang);
    $projectsTranslation->title = $request->input('title_'.$lang);
    $projectsTranslation->presentation = $request->input('presentation_'.$lang);
    $projectsTranslation->video = $request->input('video_'.$lang);
    $projectsTranslation->clients= $request->input('clients_'.$lang);
    $projectsTranslation->status= $request->input('status_'.$lang);
    $projectsTranslation->location= $request->input('location_'.$lang);
    $projectsTranslation->gallary= $request->input('gallary_'.$lang);
    if($file = $request->hasFile('main_image_'.$lang)) {
      $file = $request->file('main_image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/projects/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $projectsTranslation->main_image=$data->main_image;
      }else{
        $file->move($destinationPath,$fileName);
        $projectsTranslation->main_image=$fileName ;
      }
    }
    $projectsTranslation->projects_id=$data->projects_id;
    $projectsTranslation->locale=$lang;


    $projectsTranslation->save() ;


    if($request->hasFile('images_'.$lang)) {
      $destinationPath = public_path().'/Uploads/projects/projects_images/' ;
      $files = $request->file('images_'.$lang);
      // Making counting of uploaded images
      $file_count = count($files);
      // start count how many uploaded
      $uploadcount = 0;
      foreach($files as $file) {
        $rules = array('file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make(array('file'=> $file), $rules);
        if($validator->passes()){
          $extension = $file->getClientOriginalExtension();
          $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
          $fileName = str_replace(' ', '', $fileName);
          //$fileName = $file->getClientOriginalName() ;
          $destinationPath = public_path().'/Uploads/projects/project_images' ;
          if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
          }
          $file->move($destinationPath,$fileName);
          $projectsImage=  new ProjectsImages;
          $projectsImage->image=$fileName;
          $projectsImage->projects_translation_id=$projectsTranslation->projects_translations_id;
          $projectsImage->save();
        }
      }

    }



    if($request->hasFile('plans_'.$lang)) {
      $destinationPath = public_path().'/Uploads/projects/projects_plans/' ;
      $files = $request->file('plans_'.$lang);
      // Making counting of uploaded images
      $file_count = count($files);
      // start count how many uploaded
      $uploadcount = 0;
      foreach($files as $file) {
        $rules = array('file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make(array('file'=> $file), $rules);
        if($validator->passes()){
          $extension = $file->getClientOriginalExtension();
          $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
          $fileName = str_replace(' ', '', $fileName);
          //$fileName = $file->getClientOriginalName() ;
          $destinationPath = public_path().'/Uploads/projects/projects_plans' ;
          if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
          }
          $file->move($destinationPath,$fileName);
          $projectsPlans=  new ProjectsPlans;
          $projectsPlans->image=$fileName;
          $projectsPlans->projects_translation_id=$projectsTranslation->projects_translations_id;
          $projectsPlans->save();
        }
      }

    }
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

    return redirect()->route('projects.index')
    ->with('success','Projects created successfully');
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
    $item = Projects::find($id);
    return view('Backend/Projects.show',compact('item'));

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
    $item = Projects::find($id);
    $projectsCategory= ProjectsCategory::where('parent','!=','0')->lists('title','projects_category_id');
    return view('Backend/Projects.edit',compact('item','projectsCategory','languages'));
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
      'projects_category_id_'.$lang => 'required',
      'description_'.$lang => 'required',
      'main_image_'.$lang => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $projects=Projects::find($id);
    $projects->show_home =  $request->input('show_home_'.$lang);
    $projects->publish =  $request->input('publish_'.$lang);
    $projects->sort = $request->input('sort_'.$lang);
    $projects->projects_category_id =  $request->input('projects_category_id_'.$lang);
    $projects->description =  $request->input('description_'.$lang);
    $projects->title = $request->input('title_'.$lang);
    $projects->presentation = $request->input('presentation_'.$lang);
    $projects->video = $request->input('video_'.$lang);
    $projects->clients= $request->input('clients_'.$lang);
    $projects->status= $request->input('status_'.$lang);
    $projects->location= $request->input('location_'.$lang);
    $projects->gallary= $request->input('gallary_'.$lang);

    if($file = $request->hasFile('main_image_'.$lang)) {
      $file = $request->file('main_image_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/projects/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $projects->main_image = $fileName ;
    }
    $projects->update();
    return $projects;
  }
  public function updateDataLanguage($request,$lang,$data,$projectId){
    $id=$request->input('projects_translations_id_'.$lang);
    $projectsTranslation = ProjectsTranslation::find($id);
    if($projectsTranslation){
      $exists=true;
      $projectsTranslation = ProjectsTranslation::find($id);
    }else{
      $exists=false;
      $projectsTranslation = new ProjectsTranslation;
    }//$id
    $projectsTranslation->title = $request->input('title_'.$lang);

    $projectsTranslation->show_home =  $request->input('show_home_'.$lang);
    $projectsTranslation->publish =  $request->input('publish_'.$lang);
    $projectsTranslation->sort = $request->input('sort_'.$lang);
    $projectsTranslation->projects_category_id =  $request->input('projects_category_id_'.$lang);
    $projectsTranslation->description =  $request->input('description_'.$lang);
    $projectsTranslation->title = $request->input('title_'.$lang);
    $projectsTranslation->presentation = $request->input('presentation_'.$lang);
    $projectsTranslation->video = $request->input('video_'.$lang);
    $projectsTranslation->clients= $request->input('clients_'.$lang);
    $projectsTranslation->status= $request->input('status_'.$lang);
    $projectsTranslation->location= $request->input('location_'.$lang);
    $projectsTranslation->gallary= $request->input('gallary_'.$lang);

    if($file = $request->hasFile('main_image_'.$lang)) {
      $file = $request->file('main_image_'.$lang) ;
      $extension = $file->getOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/projects/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $Languages=Languages::get()[0];

      if($lang==$Languages->code){
        $projectsTranslation->main_image=$data->main_image;
      }else{
        $file->move($destinationPath,$fileName);
        $projectsTranslation->main_image=$fileName ;
      }
    }
    if($exists){
      $projectsTranslation->update() ;
    }else{
      $projectsTranslation->locale=$lang ;
      $projectsTranslation->projects_id=$projectId ;

      $projectsTranslation->save() ;
    }
    if($request->hasFile('images_'.$lang)) {
      $destinationPath = public_path().'/Uploads/projects/projects_images/' ;
      $files = $request->file('images_'.$lang);
      // Making counting of uploaded images
      $file_count = count($files);
      // start count how many uploaded
      $uploadcount = 0;
      foreach($files as $file) {
        $rules = array('file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make(array('file'=> $file), $rules);
        if($validator->passes()){
          $extension = $file->getClientOriginalExtension();
          $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
          $fileName = str_replace(' ', '', $fileName);
          //$fileName = $file->getClientOriginalName() ;
          $destinationPath = public_path().'/Uploads/projects/project_images' ;
          if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
          }
          $file->move($destinationPath,$fileName);
          $projectsImage=  new ProjectsImages;
          $projectsImage->image=$fileName;
          $projectsImage->projects_translation_id=$projectsTranslation->projects_translations_id;
          $projectsImage->save();
        }
      }

    }
    if($request->hasFile('plans_'.$lang)) {
      $destinationPath = public_path().'/Uploads/projects/projects_plans/' ;
      $files = $request->file('plans_'.$lang);
      // Making counting of uploaded images
      $file_count = count($files);
      // start count how many uploaded
      $uploadcount = 0;
      foreach($files as $file) {
        $rules = array('file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validator = Validator::make(array('file'=> $file), $rules);
        if($validator->passes()){
          $extension = $file->getClientOriginalExtension();
          $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
          $fileName = str_replace(' ', '', $fileName);
          //$fileName = $file->getClientOriginalName() ;
          $destinationPath = public_path().'/Uploads/projects/projects_plans' ;
          if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
          }
          $file->move($destinationPath,$fileName);
          $projectsPlans=  new ProjectsPlans;
          $projectsPlans->image=$fileName;
          $projectsPlans->projects_translation_id=$projectsTranslation->projects_translations_id;
          $projectsPlans->save();
        }
      }

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
    $Languages=Languages::get();
    foreach ($Languages as $key => $item) {
      if($key==0){
        $data=$this->updateDatMain($request,$item->code,$id);
      }
      $this->updateDataLanguage($request,$item->code,$data,$id);
      // code...
    }

    //

    return redirect()->route('projects.index')
    ->with('success','Projects updated successfully');

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

  public function deleteProjectsImages(Request $request){
    ProjectsImages::find($request->id)->delete();
    return response()->json(true);
  }

  public function deleteProjectsPlans(Request $request){
    ProjectsPlans::find($request->id)->delete();
    return response()->json(true);
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if(Projects::find($id)){
      Projects::find($id)->delete();
      $affectedRows2 = ProjectsTranslation::where('projects_id', '=', $id)->delete();

    }
    return redirect()->route('projects.index')
    ->with('success','Projects deleted successfully');

  }
}
