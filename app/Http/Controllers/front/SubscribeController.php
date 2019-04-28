<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Newsletter;
use Validator;

class SubscribeController extends Controller
{

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function add(Request $request)
  {

    $output=array();
    $output["status"]=false;
    $accepted_origins = array("http://localhost", "http://192.168.1.1","http://www.naturedesigngroup.com");
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }
    }
    $validator = \Validator::make($request->all(), [
      'email' => 'required|email|unique:newsletter',
    ]);
    if ($validator->fails())
    {
      $output["message"]= $validator->errors()->all();
    }else{

      $newsletter	 = new Newsletter;
      $newsletter->email	 = $request->email	;
      $newsletter->save() ;
      $output["status"]=true;
      $output["message"]= "Thank you for getting in touch!";
    }
    return response()->json($output);

  }

}
