<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Projects;

use Validator;

class DashboardController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    $Projectscount = Projects::count();
    return view('Backend/Dashboard.index',compact('Projectscount'));
  }
}
