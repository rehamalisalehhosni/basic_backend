<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Validator;

class SocialMediaController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $socialMedia = SocialMedia::orderBy('social_media_id','DESC')->paginate(20);
    return view('Backend/SocialMedia.index',compact('socialMedia'))
    ->with('i', ($request->input('page', 1) - 1) * 20);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('Backend/SocialMedia.create');

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'link' => 'required',
      'icon' => 'required',
    ]);
    $socialMedia = new SocialMedia;
    $socialMedia->title = $request->title;
    $socialMedia->link = $request->link;
    $socialMedia->icon = $request->icon;
    $socialMedia->sort = $request->sort;
    $socialMedia->save() ;
    return redirect()->route('socialMedia.index')
    ->with('success','Social Media Created Successfully');
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
    $item = SocialMedia::find($id);
    return view('Backend/SocialMedia.show',compact('item'));

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $item = SocialMedia::find($id);
    return view('Backend/SocialMedia.edit',compact('item'));

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
    $this->validate($request, [
      'title' => 'required',
      'link' => 'required',
      'icon' => 'required',
    ]);
    $socialMedia=SocialMedia::find($id);
    //->update($request->all());
    $socialMedia->title = $request->title;
    $socialMedia->icon = $request->icon;
    $socialMedia->link = $request->link;
    $socialMedia->sort = $request->sort;
    $socialMedia->update() ;
    return redirect()->route('socialMedia.index')
    ->with('success','Social Media updated successfully');
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
    SocialMedia::find($id)->delete();
    return redirect()->route('socialMedia.index')
    ->with('success','Social Media deleted successfully');
  }

}
