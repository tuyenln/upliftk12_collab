<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\District;
use App\SchoolDistrict;
use App\User;
use App\Role\UserRole;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$current_user = Auth::user();
        $schools = null;
        if($request->has('district_id')){
            $schools = SchoolDistrict::where('district', $request->district_id)->get();
        }
        if($request->has('school_id')){
            $schools = SchoolDistrict::findOrFail($request->school_id);
        }
        $aQvars = $request->query();
        if($current_user->is_admin){
        	$aRows = User::teacher()
                    ->where(function($query) use ($request) {
                        if($request->has('district_id')){
                           $query->where('district', $request->district_id);
                        }
                        if($request->has('school_id')){
                           $query->where('school_district', $request->school_id);
                        }
                    })
                    ->where('school_district', '!=', null)
                    ->paginate(10);
        }else {
        	$aRows = User::teacher()->where('school_district', $current_user->school_district)->paginate(10);
        }
        $districts = District::where('status',1)->get();

        return view('admin.teacher.index',compact('aRows', 'districts', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::where('status',1)->get();
        $user = Auth::user();
        return view('admin.teacher.add',compact('districts', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = Auth::user();
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'state_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = new User();

        $user->name = $request->first_name.' '.$request->last_name;
        $user->district = $request->district_name;
        $user->school_district = $request->school_name;
        $user->state = $request->state_name;
        $user->email = $request->email;
        $user->user_type = UserRole::TEACHER;
        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->flash('alert-success', 'Teacher was successful added!');
        if($current_user->is_admin){
            return redirect()->route("admin.teacher.index")->with('message', 'Teacher was successful added!');
        }else {
            return redirect()->route("principal.teacher.index")->with('message', 'Teacher was successful added!');
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = Auth::user();
        $aRow = User::findOrFail($id);
        if(!$user->is_admin && $user->school_district != $aRow->school_district){
        	return redirect()->route('principal.teacher.index');
        }
        $districts = District::where('status',1)->get();

        if($user->is_admin)
            return view('admin.teacher._add',compact('districts', 'aRow', 'user'));
        else
            return view('admin.teacher.add',compact('districts', 'aRow', 'user'));
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
        $current_user = Auth::user();
        $user = User::findOrFail($id);
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'state_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password'              => 'nullable|min:6',
            'confirm_password' => 'nullable|same:password'
        ]);

        $user->name = $request->first_name.' '.$request->last_name;
        $user->district = $request->district_name;
        $user->school_district = $request->school_name;
        $user->state = $request->state_name;
        $user->email = $request->email;
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if($current_user->is_admin){
            return redirect()->route("admin.teacher.index")->with('message', 'Teacher updated Successfully!');
        }else {
            return redirect()->route("principal.home")->with('message', 'Teacher updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = User::findOrFail($id);
        $current_user = Auth::user();
        $aRow = User::findOrFail($id);
        if(!$current_user->is_admin && $current_user->school_district != $aRow->school_district){
            return redirect()->route('principal.teacher.index');
        }
        $aRow->delete();
        if($current_user->is_admin){
            return redirect()->route("admin.teacher.index")->with('message', 'Teacher deleted Successfully.');
        }else {
            return redirect()->route("principal.teacher.index")->with('message', 'Teacher deleted Successfully.');
        }
    }

    public function getSchools(Request $request) {
        $schools = SchoolDistrict::where('district', $request->district_id)->get();
        $str = '';
        foreach ($schools as $school)
        {
            $str = $str . ('<option value="' . $school->id . '">' . $school->school . '</option>');
        }
        return $str;
    }

    public function addSchools(Request $request) {
        $user = Auth::user();
        $districts = District::where('status',1)->get();
        return view('admin.teacher.add-school', compact('districts', 'user'));
    }

    public function addSchoolPost(Request $request) {
        $district_id = $request->district_id;
        $school_name = $request->school_name;

        if ($district_id == null) {
            return redirect()->back()->with('alert-danger', 'The school district should be selected');
        }
        $school_names = SchoolDistrict::where('status', 1)->where('district', $district_id)->pluck('school');
        if ( count($school_names) > 0 && in_array($school_name, $school_names)) {
            return redirect()->back()->with('alert-danger', 'The school name is already exist.');
        }
        $data = array(
            'school'        =>  $school_name,
            'district'      =>  $district_id,
            'description'   =>  '',
            'date_created' =>  date('y-m-d h:i:s'),
            'status'        =>  1  
        );
        SchoolDistrict::create($data);
        return redirect()->back()->with('alert-success', 'The School is successfully added');
    }

    public function addDistrictPost(Request $request) {
        $distirct = $request->district;
        $data = array(
            'name'  =>  strtoupper($distirct),
            'description'   =>  '',
            'date_created'  =>  date('y-m-d h:i:s'),
            'status'    =>  1
        );
        District::create($data);
        return redirect()->back()->with('alert-success', 'District is successfully added');
    }
}
