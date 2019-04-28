<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

use Validator;

class ContactRequestController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $contactUs = ContactUs::orderBy('contact_us_id','DESC')->paginate(5);
    return view('Backend/ContactUs.index',compact('contactUs'))
    ->with('i', ($request->input('page', 1) - 1) * 5);
  }


}
