<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Languages;
use Validator;

class LanguagesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $languages = Languages::orderBy('languages_id','DESC')->paginate(20);
    return view('Backend/Languages.index',compact('languages'))
    ->with('i', ($request->input('page', 1) - 1) * 20);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('Backend/Languages.create');

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
      'code' => 'required',
    ]);
    $languages = new Languages;
    $languages->title =$request->title;
    $languages->code = $request->code;
    $languages->sort = $request->sort;
    $languages->save() ;
    return redirect()->route('languages.index')
    ->with('success','Languages Created Successfully');
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
    $item = Languages::find($id);
    return view('Backend/Languages.show',compact('item'));

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $item = Languages::find($id);
    return view('Backend/Languages.edit',compact('item'));

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
      'code'  => 'required',
    ]);
    $languages=Languages::find($id);
    //->update($request->all());
    $languages->title = $request->title;
    $languages->code = $request->code;
    $languages->sort = $request->sort;
    $languages->update() ;
    return redirect()->route('languages.index')
    ->with('success','Languages updated successfully');
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

    Languages::find($id)->delete();
    return redirect()->route('languages.index')
    ->with('success','Languages deleted successfully');
  }

}
