<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ProjectsCategory;
use App\Models\ProjectsCategoryTranslation;
use App\Models\Languages;

class ProjectsCategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $projectsCategory = ProjectsCategory::orderBy('projects_category_id','DESC')->paginate(20);
        return view('Backend/ProjectsCategory.index',compact('projectsCategory'))
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
        $projectsCategory=ProjectsCategoryTranslation::all();

        return view('Backend/ProjectsCategory.create',compact('languages','projectsCategory'));
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
        ]);
        $projectsCategory = new ProjectsCategory;
        $projectsCategory->title = $request->input('title_'.$lang);
        $projectsCategory->parent = $request->input('parent_'.$lang);
        $projectsCategory->theme = $request->input('theme_'.$lang);
        $projectsCategory->sort = $request->input('sort_'.$lang);
        $projectsCategory->description = $request->input('description_'.$lang);
        $projectsCategory->save() ;
        return $projectsCategory;
      }
      public function setDataLanguage($request,$lang,$data)
      {
        $projectsCategoryTranslation = new ProjectsCategoryTranslation;
        $projectsCategoryTranslation->title = $request->input('title_'.$lang);
        $projectsCategoryTranslation->parent = $request->input('parent_'.$lang);
        $projectsCategoryTranslation->theme = $request->input('theme_'.$lang);
        $projectsCategoryTranslation->sort = $request->input('sort_'.$lang);
        $projectsCategoryTranslation->description = $request->input('description_'.$lang);

        $projectsCategoryTranslation->projects_category_id=$data->projects_category_id	;
        $projectsCategoryTranslation->locale=$lang;
        $projectsCategoryTranslation->save() ;
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
        return redirect()->route('projectCategory.index')
        ->with('success','Projects Category created successfully');

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
        $projectsCategory = ProjectsCategory::find($id);
        return view('Backend/ProjectsCategory.show',compact('projectsCategory'));

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
        $projectsCategory=ProjectsCategoryTranslation::all();
        $item = ProjectsCategory::find($id);

        return view('Backend/ProjectsCategory.edit',compact('item','languages','projectsCategory'));

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
      ]);

      $projectsCategory=ProjectsCategory::find($id);
      $projectsCategory->title = $request->input('title_'.$lang);
      $projectsCategory->parent = $request->input('parent_'.$lang);
      $projectsCategory->theme = $request->input('theme_'.$lang);
      $projectsCategory->sort = $request->input('sort_'.$lang);
      $projectsCategory->description = $request->input('description_'.$lang);


      $projectsCategory->update();
      return $projectsCategory;
    }
    public function updateDataLanguage($request,$lang,$data,$projectsCategoryId){
      $id=$request->input('projects_category_translations_id_'.$lang);
      $projectsCategoryTranslation = ProjectsCategoryTranslation::find($id);
      if($projectsCategoryTranslation){
        $exists=true;
        $projectsCategoryTranslation = ProjectsCategoryTranslation::find($id);
      }else{
        $exists=false;
        $projectsCategoryTranslation = new ProjectsCategoryTranslation;
      }//$id
      $projectsCategoryTranslation->title = $request->input('title_'.$lang);
      $projectsCategoryTranslation->parent = $request->input('parent_'.$lang);
      $projectsCategoryTranslation->theme = $request->input('theme_'.$lang);
      $projectsCategoryTranslation->sort = $request->input('sort_'.$lang);
      $projectsCategoryTranslation->description = $request->input('description_'.$lang);

      if($exists){
        $projectsCategoryTranslation->update() ;
      }else{
        $projectsCategoryTranslation->locale=$lang ;
        $projectsCategoryTranslation->projects_category_id=$projectsCategoryId ;
        $projectsCategoryTranslation->save() ;
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
      return redirect()->route('projectCategory.index')
        ->with('success','Projects Category updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      if(ProjectsCategory::find($id)){
        ProjectsCategory::find($id)->delete();
        $affectedRows2 = ProjectsCategoryTranslation::where('projects_category_id', '=', $id)->delete();
      }
        return redirect()->route('projectCategory.index')
        ->with('success','Projects Category deleted successfully');

    }
}
