<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Setting;
use Mail;

use Validator;

class NewsletterController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $newsletter = Newsletter::orderBy('newsletter_id','DESC')->paginate(20);
    return view('Backend/Newsletter.index',compact('newsletter'))
    ->with('i', ($request->input('page', 1) - 1) * 20);
  }
  public function message(Request $request)
  {

    return view('Backend/Newsletter.message');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function send(Request $request)
  {
    $this->validate($request, [
      'subject' => 'required',
      'message' => 'required',
    ]);
    $newsletter = Newsletter::orderBy('newsletter_id','DESC')->get();
    $emails = array_map(function($element) {
      return $element['email'];
    },
    $newsletter->toArray()
  );
  $setting = Setting::find(1);

  Mail::send('Emails.newsletter', ['data' => $request], function ($message) use ($emails,$request,$setting)
  {
    $message->from($setting->email, $setting->name);
    $message->to($emails)->subject($request->subject.'|'.'Newsletter');
  });
  return redirect()->route('newsletter.index')
  ->with('success','Emails Sent successfully');
}



}
