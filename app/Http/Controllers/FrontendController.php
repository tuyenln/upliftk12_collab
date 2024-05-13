<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;
use Mail;
use Session;
use Validator;
use Carbon\Carbon;

use App\District;
use App\Role\UserRole;
use App\User;
use App\TeacherSignup;

use App\Mail\SendMailContact;
use App\Mail\SendMailActivate;
use App\Mail\SendMailNewsletter;

class FrontendController extends Controller
{
    
    public function freeTrial()
    {
      $districts = District::where('status',1)->get();
      return view('free-trial');
    }

    public function freeTrialSuccess(Request $request){

    	return view('freetrial-success');
    }

    public function postFreeTrial(Request $request)
    {

      $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        // 'school_id' => 'required|numeric',
        'state_name' => 'required',
        'district_name' => 'required',
        'school_name' => 'required',
        'phone' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
        'agree' => 'required',
      ], [

      ]);

      $user = new User();

      $user->name = $request->name;
      // $user->district = $request->district_id;
      // $user->school_district = $request->school_id;
      // $user->state = $request->state_name;
      $user->email = $request->email;
      $user->username = $request->username;
      $user->user_type = UserRole::TEACHER;
      $user->password = Hash::make($request->password);
      if($user->save()){
        $ts = new TeacherSignup();

        $date = Carbon::now();
        $date->addDays(30);

        $ts->user_id = $user->id;
        $ts->phone = $request->phone;
        $ts->state = $request->state_name;
        $ts->district = $request->district_name;
        $ts->school = $request->school_name;
        $ts->expired = $date;
        $ts->save();
        
        $hash = hash_hmac('sha256', str_random(40), config('app.key'));
        $url = url('teacher/activation', $hash);
        DB::table('user_activations')->insert([
          'user_id' => $user->id,
          'token' => $hash
        ]);
        Mail::to($user->email)->send(new SendMailActivate(['url' => $url]));
        //redirect to success page
      	$msg = 'You\'re in! In order to activate your free trial, please confirm your email address!';
        $request->session()->flash('success', $msg);
    	return redirect()->route('success-freetrial');
      }else {
        $errors = new \Illuminate\Support\MessageBag();
        // add your error messages:
        $errors->add('err', 'Error!');
        return redirect()->back()->withErrors($errors);
      }
    }

    public function teacherActivation(Request $request, $token)
    {
      $msg = 'Your email has been confirmed. You may now login to get started. If you run into any issues, please don\'t hesitate to contact us at teach@upliftk12.com';
      $check = DB::table('user_activations')->where('token', $token)->first();
      if(!is_null($check)){
        $user = User::find($check->user_id);
        if ($user->email_verified_at != null){
            // Auth::loginUsingId($user->id);
            $request->session()->flash('success', $msg);
            return view('activation');
        }
        // $user->update(['email_verified_at' => Carbon::now()]);
        $user->email_verified_at = Carbon::now();
        $user->save();
        DB::table('user_activations')->where('token', $token)->delete();
        // Auth::loginUsingId($user->id);
        $request->session()->flash('success', $msg);
        return view('activation')->with('success');
      }
      $request->session()->flash('error', 'Not Found.');
      return view('activation');
    }

    public function newsletter(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email'
      ],[
      	'email.required' => 'The email field is required!'
      ]);
      if($validator->fails()){
        return response()->json([
          'status' => 'error',
          'message' => $validator->errors()->first()
        ]);
      }
      // sleep(20);
      $subject = 'Newsletter inquiry - Front Page';
      // Mail::to($request->email)->send(new SendMailNewsletter(['email' => $request->email]));
      Mail::raw("Email: $request->email", function ($message) use ($subject) {
          $message->to('mshah@upliftk12.com');
          $message->subject($subject);
      });
      return response()->json([
        'status' => 'success',
        'message' => 'Successfully!'
      ]);
    }

    public function termOfUse()
    {
      return view('term-of-use');
    }

    public function privacyPolicy()
    {
      return view('privacy-policy');
    }
}
