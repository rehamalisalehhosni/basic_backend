<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Mail;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingTranslation;
use App\Models\ContactUs;
use App\Models\PagesTranslation;
use App\Models\SocialMedia;



class ContactUsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $id=1;
    $locale = App::getLocale();
    $setting = SettingTranslation::where(['locale'=>$locale,'setting_id'=>$id])->first();
    $banner= PagesTranslation::where('locale',$locale)->where('page','=','Contact us')->get();

    $social = SocialMedia::get();
    $setting= SettingTranslation::where('locale',$locale)->first();

    return view('Front/'.$setting->active_theme.'/ContactUs.index',compact('setting','social','banner'))
    ->with('i', ($request->input('page', 1) - 1) * 5);
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
      'name' => 'required|min:5',
      'email' => 'required|email',
      'phone' => 'required|regex:/(01)[0-9]{9}/',
      'message' => 'required|min:5',
    ]);
    $contactus	 = new ContactUs;
    $contactus->name	 = $request->name	;
    $contactus->email	 = $request->email	;
    $contactus->phone	 = $request->phone	;
    $contactus->message	 = $request->message	;
    $contactus->save() ;
    if ($contactus){
      $id=1;
      $setting = Setting::find($id);
      $data = array('name'=>$contactus->name);
      $title="Contactus";
      $content=$contactus->message;
    /*  Mail::send('Emails.contactus', ['contactus' => $contactus], function ($message)use ($setting,$contactus)
      {
        $message->from($contactus->email, $contactus->name);
        $message->to($setting->email)->subject($setting->company_name.'|'.'Contact Us');
      });*/
    /*  Mail::send(['text'=>'mail'], $data, function($message) use ($setting,$contactus) {
        $message->to('engreham.ali2011@gmail.com', $setting->company_name)->subject
        ($setting->company_name.'|'.'Contact Us');
        $message->from($contactus->email,$contactus->name);
      });
*/
    }

    return redirect()->route('contactUs.index',App::getLocale())
    ->with('success','Message sent successfully');
  }

}
