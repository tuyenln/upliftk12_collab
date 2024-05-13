<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use App\District;
use App\SchoolDistrict;
use App\User;
use App\Role\UserRole;

class PrincipalController extends Controller
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
        $schools = '';
        $aQvars = $request->query();
        if($request->has('district_id')){
            $schools = SchoolDistrict::where('district', $request->district_id)->get();
        }
        if($request->has('school_id')){
            $school = SchoolDistrict::findOrFail($request->school_id);
        }
        $aRows = User::principal()
                ->where(function($query) use ($request) {
                    if($request->has('district_id')){
                       $query->where('district', $request->district_id); 
                    }
                    if($request->has('school_id')){
                       $query->where('school_district', $request->school_id); 
                    }
                })
                ->paginate(10);
        $districts = District::where('status',1)->get();
        return view('admin.principal.index',compact('aRows', 'districts', 'schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::where('status',1)->get();
        return view('admin.principal.add',compact('districts'));
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
        $user->user_type = UserRole::PRINCIPAL;
        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->flash('alert-success', 'User was successful added!');
        return redirect()->route("admin.principal.index")->with('message', 'User was successful added!');
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
        $aRow = User::findOrFail($id);
        $districts = District::where('status',1)->get();
        return view('admin.principal.add',compact('districts', 'aRow'));
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

        return redirect()->route("admin.principal.index")->with('message', 'Principal updated Successfully.'); 
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
        $aRow->delete();        
        return redirect()->route("admin.principal.index")->with('message', 'Principal deleted Successfully.');
    }
}
