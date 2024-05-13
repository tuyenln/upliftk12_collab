<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class AjaxController extends Controller
{
   
  public function get_school_dist(Request $req)
  {
    $id=$req->department;
    //$districts=DB::table('school_district')->where('district',$id)->where('status',1)->get();

    $districts = DB::table('school_district')
            ->join('users', 'users.school_district', '=', 'school_district.id')
            ->select('school_district.*')
            ->where('status',1)->where('school_district.district',$id)
            ->distinct()->get(['users.school_district']);

    $html='<option value="">--Select School Name --</option>';
    foreach($districts as $districts){
        $html .='<option value="'.$districts->id.'">'.$districts->school.'</option>';
    }
    return $html;
  }



    
}
