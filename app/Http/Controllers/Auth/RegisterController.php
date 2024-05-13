<?php
namespace App\Http\Controllers\Auth;

use App\District;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Role\UserRole;
use Auth;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'fist_name' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'state_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function teachersignup(Request $request)
    {
        $districts = District::all();

        return view('auth.teachersignup',compact('districts'));
    }

    public function teachersignuppost(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email'    => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $aVals = $request->all();
        User::create([
            'name' => $aVals['fname'],
            'lname' => $aVals['lname'],
            'email' => $aVals['email'],
            'password' => Hash::make($aVals['password']),
            'user_type' => UserRole::TEACHER,
            'district' => $aVals['district_name'],
            'school_district' => $aVals['school_name'],
            'parent_user_id' => -1,
        ]);

        Auth::attempt(['email'=>$aVals['email'], 'password'=>$aVals['password']]);
        return redirect('/teacher/update-payment-method');

        return redirect('teacher/signup')->with('message', 'You signup Successfully.');
    }
}
