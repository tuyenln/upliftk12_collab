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
use App\TeacherSignup;
use App\Role\UserRole;

class TeacherSignupController extends Controller
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
        $aQvars = $request->query();
        if($current_user->is_admin){
        	$aRows = User::teacher()
            ->select('users.*', 'teachers_signup.district', 'teachers_signup.school', 'teachers_signup.phone')
            ->join('teachers_signup', 'users.id', '=', 'teachers_signup.user_id')
                    // ->whereNull('school_district')
                    ->paginate(10); 
        }else {
        	$aRows = User::teacher()->where('school_district', $current_user->school_district)->paginate(10); 
        }
        $districts = District::where('status',1)->get();

        return view('admin.teacher.list-signup',compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
    	$current_user = Auth::user();
        $aRow = User::findOrFail($id);
        $districts = District::where('status',1)->get();
        return view('admin.teacher.edit-signup',compact('districts', 'aRow'));
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
            'name' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'state_name' => ['required', 'string', 'max:255'],
            'phone' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $teacher_signup = $user->teacher_signup;
        $teacher_signup->state = $request->state_name;
        $teacher_signup->district = $request->district_name;
        $teacher_signup->school = $request->school_name;
        $teacher_signup->phone = $request->phone;
        $teacher_signup->save();

        return redirect()->route("admin.teacher.signup.index")->with('message', 'Teacher updated Successfully!');
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
        $aRow->teacher_signup->delete();
        $aRow->delete();
        return redirect()->route("admin.teacher.signup.index")->with('message', 'Teacher deleted Successfully.');
    }
}
