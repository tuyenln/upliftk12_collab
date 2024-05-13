<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role\UserRole;
class PrincipalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request) {
    
    $user =new User();

    $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'state_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => 'required|min:6',
            'confirm_password' => 'required|same:password' 
        ]);

        $user->name = $request->first_name.' '.$request->last_name;
        $user->district = $request->district_name;
        $user->school_district = $request->school_name;
        $user->state = $request->state_name;
        $user->email = $request->email;
        $user->user_type = UserRole::PRINCIPAL;
        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->flash('alert-success', 'User was successful added!');
        return redirect()->route("admin.home");
    }

    
}
