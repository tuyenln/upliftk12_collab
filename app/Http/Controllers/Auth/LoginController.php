<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role\UserRole;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
*/
  protected $username;


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';



    protected function redirectTo() {


      if(Auth::user()->user_type == UserRole::ADMIN) {
        return '/admin/';
      }
      if(Auth::user()->user_type == UserRole::PRINCIPAL){
          return '/principal';
      }
      if(Auth::user()->user_type == UserRole::TEACHER){

         return '/teacher';
      }
      if(Auth::user()->user_type == UserRole::STUDENT){
          return '/student/';
      }
    }

    public function findUsername()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function login(Request $request)
    {
      $fieldType = $this->findUsername();
      // check teacher signup
      if($fieldType == 'email'){
        $user = User::where('email', $request->email)->first();
      }else {
        $user = User::where('username', $request->username)->first();
      }
      if($user){
        if($user->teacher_signup && !$user->email_verified_at){
          $request->session()->flash('error', 'Your account has not activated');
          return redirect()->back();
        }
      }

      // check attempt
      if($fieldType == 'email'){
        $credentials = Auth::attempt(request()->only('email', 'password'));
      }else {
        $credentials = Auth::attempt(request()->only('username', 'password'));
      }
      if($credentials) {
        return redirect($this->redirectTo());
      }else {
          $request->session()->flash('error', 'Please, check your credentials');
          return redirect()->back();
      }
    }

     public function username()
    {
        return $this->username;
    }

    public function logout(Request $request) {
      $aUrl = '/login';
      if(Auth::user() && Auth::user()->user_type == UserRole::ADMIN)
      {
            /*$aUrl = '/admin';*/
      }
      Auth::logout();
      return redirect($aUrl);
    }


    public function fastLogin(Request $request)
    {
      $fullUrl = $request->fullUrl();
      $arrayUrl = explode('/', $fullUrl);
      $index = count($arrayUrl) - 1;
      $password = $arrayUrl[$index];
      $username = $arrayUrl[$index-1];

      $fieldType = $this->findUsername();
      // check teacher signup
      if($fieldType == 'email'){
        $user = User::where('email', $request->email)->first();
      }else {
        $user = User::where('username', $username)->first();
      }
      if($user){
        if($user->teacher_signup && !$user->email_verified_at){
          $request->session()->flash('error', 'Your account has not activated');
          return redirect()->back();
        }
      }
      $login = [
        'username' => $username,
        'password' => $password
      ];
      // check attempt
      if($fieldType == 'email'){
        $credentials = Auth::attempt(request()->only('email', 'password'));
      }else {
        $credentials = Auth::attempt($login);
      }

      if($credentials) {
        return redirect($this->redirectTo());
      }else {
          $request->session()->flash('error', 'Please, check your credentials');
          return redirect()->back();
      }
    }
}
