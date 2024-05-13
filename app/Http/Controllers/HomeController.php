<?php

namespace App\Http\Controllers;

use App\GradeLevel;
use App\QuizData;
use App\ResourceType;
use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;
use Mail;
use File;
use Session;
use Validator;
use Stripe;
use Exception;
use Carbon\Carbon;
use App\Role\UserRole;
use App\Contact;
use App\SchoolClass;
use App\Assessment;
use App\Invite;
use App\District;
use App\SchoolDistrict;
use App\User;
use App\TeacherSignup;
use App\Subject;
use App\DemoRequest;
use App\CancelReason;
use App\SurveyData;
use App\ActivityHelp;

use App\Mail\SendMailContact;
use App\Mail\SendMailActivate;
use App\Mail\SendMailNewsletter;
use App\Mail\GetDemo;

use App\Lesson;
use App\Course;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     /*   $this->middleware('auth', ['except' => [
                                    'homepage', 'contact', 'submitContact',
                                    'about', 'solutions', 'captivate',
                                    'freeTrial', 'postFreeTrial', 'teacherActivation', 'termOfUse', 'privacyPolicy', 'newsletter'
                                  ]
        ]); */
    }

    public function student()
    {

        $user = Auth::user();


        $sc = SchoolClass::whereJsonContains('student_lists', $user->id)->get();
        $list_subjects = $sc->pluck('subject_id')->toArray();


        $lesson_ids = Lesson::getLessons($user->id);
        //return $lesson_ids;
        //$lessons = DB::table('lessons')->whereIn('id', $lesson_ids)->get();
        $lessons = [];
        $lesId = [];
        foreach ($lesson_ids as $t) {
            $lessons[] = Lesson::find($t['lesson_id']);
            $lesId[] = $t['lesson_id'];
        }

        $invite_urls = array();
        $loop = 0;

        $list_asm = Assessment::whereIn('subject', $list_subjects)->get();
        $activity_lesson = Lesson::whereIn('id', $lesId)->get();

        $invite_activity_urls = array();
        foreach($activity_lesson as $lesson) {
          $uuid = $this->generateRandomString(5) . $user->id . 'Z' . $this->generateRandomString(5) . $lesson->id;
          $invite_activity_urls[] = $uuid;
        }


        if (!empty($user)) {
          $quizData = QuizData::leftJoin('lessons', 'lessons.id', '=', 'quiz_data.invite_id')->leftJoin('users', 'users.id', '=', 'quiz_data.student_id')
          ->where('user_type', '=', UserRole::STUDENT)->where('quiz_data.student_id', $user->id)->select('quiz_data.*', 'users.username as uname', 'lessons.name as lname')->get();
        } else {
          $quizData = [];
        }


        $mdlCat = SchoolClass::whereJsonContains('student_lists', $user->id)->where('subject_id',4)->select('grade_level_id')->get();
        return view('student.index', compact('user', 'list_asm','mdlCat', 'lesson_ids', 'activity_lesson', 'invite_activity_urls', 'quizData'));

    }

    public function reading()
    {

        $user = Auth::user();
        $sc = SchoolClass::where('student_lists', 'like', '%'.$user->id.'%')->get();
        $list_subjects = $sc->pluck('subject_id')->toArray();

        $list_asm = Assessment::whereIn('subject', $list_subjects)->get();
        return view('student.reading', compact('user', 'list_asm'));


    }

    public function teacher()
    {
      $user = Auth::user();

      $lessons = Lesson::paginate(25);

      $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();

      $invite_urls = array();
      foreach($lessons as $lesson) {
        $uuid = $this->generateRandomString(5) . $user->id . 'Z' . $this->generateRandomString(5) . $lesson->id;
        $invite_urls[] = $uuid;
      }
      if((!Session::get('selectedClass')) && count($classes) > 0)
        Session::put('selectedClass', $classes[0]);

      $empty_class = SchoolClass::first();
      if($user->teacher_signup || count($classes) == 0) {
          Session::put('selectedClass', $empty_class);
      }

      $subjects = Subject::all();

        $lesson_ids = Session::get('selectedClass') ? Lesson::getLessonswithClass($user->id, Session::get('selectedClass')->id) : [];
        //return $lesson_ids;
        //$lessons = DB::table('lessons')->whereIn('id', $lesson_ids)->get();

        $learning_lessons = [];
        foreach ($lesson_ids as $t) {
            $learning_lessons[] = Lesson::find($t['lesson_id']);
        }

        $students = Session::get('selectedClass');

        if (!empty($students['student_lists'])) {
          $quizData = QuizData::leftJoin('lessons', 'lessons.id', '=', 'quiz_data.invite_id')->leftJoin('users', 'users.id', '=', 'quiz_data.student_id')
          ->where('user_type', '=', UserRole::STUDENT)->whereIn('quiz_data.student_id', $students['student_lists'])->select('quiz_data.*', 'users.name as fname', 'users.lname as lastname', 'lessons.name as lname')->get();
        } else {
          $quizData = [];
        }


        $invite_ids = array();
        if(Session::get('selectedClass'))
            $invite_ids = Invite::where('teacher_id', $user->id)->where('class_id', Session::get('selectedClass')->id)->select('id')->get();
        /*
        $temp = '(-1';
        foreach($invite_ids as $id) {
            $temp .= ', ' . $id->id;
        }
        $temp .= ')';*/
        /*
        $quiz_data = DB::select('SELECT
                COUNT( CASE WHEN score <= 50 THEN 1 END ) AS c1,
                COUNT( CASE WHEN score <= 75 AND score > 50 THEN 1 END ) AS c2,
                COUNT( CASE WHEN score > 75 THEN 1 END ) AS c3,
                invite_id,
                quiz_name,
                l.objective
            FROM
                quiz_data
            LEFT JOIN invites as i ON i.id = invite_id
            LEFT JOIN lessons as l ON l.id = i.lesson_id
            WHERE
                invite_id IN '. $temp . '
            GROUP BY
                invite_id');
        */

        $grades = GradeLevel::all();
        $resource_types = ResourceType::all();

        $activity_lesson = Lesson::where('resource_type_id', 4)->get();

        $invite_activity_urls = array();

        foreach($activity_lesson as $lesson) {
          $uuid = $this->generateRandomString(5) . $user->id . 'Z' . $this->generateRandomString(5) . $lesson->id;
          $invite_activity_urls[] = $uuid;
        }

        $class_student_names = User::whereIn('id', $students['student_lists'])->get();
        $students_id = array();
        if (!empty($students['student_lists'])) {
          $students_id = $students['student_lists'];
        }
        $activity_help = ActivityHelp::leftJoin('users', 'users.id', '=', 'tbl_activityhelp.ah_sid')->where('ah_status', 0)
        ->where(function($query) use ($user) {
          $query->orWhere('ah_tid', $user->id)
          ->orWhere('ah_tid', 0);
        });
        $activity_help = $activity_help->whereIn('ah_sid', $students_id)->get();
        $students = Session::get('selectedClass');

        $survey_lessons = SurveyData::leftJoin('lessons as l', 'l.id', '=', 'survey_data.lesson_id')->groupBy('lesson_id')->select('lesson_id', 'l.name as name')->get();
        $student_list = ActivityHelp::leftJoin('users', 'users.id', '=', 'tbl_activityhelp.ah_sid')->where('ah_status', 0)
        ->where(function($query) use ($user) {
          $query->orWhere('ah_tid', $user->id)
          ->orWhere('ah_tid', 0);
        })->pluck('ah_sid');
      return view('teacher.index', compact('user', 'activity_help', 'lessons', 'classes', 'invite_urls', 'subjects', 'learning_lessons', 'survey_lessons', 'lesson_ids', 'quizData', 'class_student_names', 'grades', 'resource_types', 'activity_lesson', 'invite_activity_urls', 'students_id', 'student_list'));

    }

    public function getQuizData(Request $request) {
      $lesson_list = $request->lesson_list;
      $student_list = $request->student_list;

        $quizData = QuizData::leftJoin('lessons', 'lessons.id', '=', 'quiz_data.invite_id')->leftJoin('users', 'users.id', '=', 'quiz_data.student_id')->where('user_type', '=', UserRole::STUDENT);
        $students = Session::get('selectedClass');
        if ($student_list != NULL) {
          $quizData = $quizData->whereIn('quiz_data.student_id', $student_list);
        } else {
          if (!empty($students['student_lists'])) {
            $quizData = $quizData->whereIn('quiz_data.student_id', $students['student_lists']);
          }  else {
            $quizData = [];
            return $quizData;
          }
        }
        if (!empty($lesson_list)) {
          $quizData = $quizData->whereIn('quiz_data.invite_id', $lesson_list);
        }
        $quizData = $quizData->select('quiz_data.*', 'users.name as fname', 'users.lname as lastname', 'lessons.name as lname')->get();
        return $quizData;
    }

    public function ajaxRequestPostProfile(Request $request){
      $id = Auth::id();
        //dd($id);
        $image = $request->avatar;
        $image = explode(";",$image)[1];

        $image = explode(",",$image)[1];
        $image = str_replace(" ", "+",$image);

        $image = base64_decode($image);
        //var_dump($image.jpeg);

         file_put_contents("public/studentprofile/avatar.$id.jpeg",$image);
        $nameImage = 'avatar.'.$id.'.jpeg';
        $user = User::find($id);
        //$user = DB::table('users')->where('mdl_UserID',$id)->where('user_type', 4)->get();

        $user->avatar = $nameImage;
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Profile inserted successfully'
            ]
        );
    }

    public function getSurveyData(Request $request) {
      $lesson_id = $request->lesson_id;
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      $start_date = date('Y-m-d', strtotime($start_date));
      $end_date = date('Y-m-d', strtotime($end_date));

      $student = Session::get('selectedClass');
      if ($student['student_lists'] == '') {
        return;
      }
      $survey_data = SurveyData::where('lesson_id', $lesson_id)->leftJoin('lessons as l', 'l.id', '=', 'survey_data.lesson_id')->whereIn('student_id', $student['student_lists'])->whereBetween('survey_data.created_at', [$start_date, $end_date])
      ->select(DB::raw('COUNT( CASE WHEN sv_answer = "Strongly Disagree" THEN 1 END) AS C1,
      COUNT( CASE WHEN sv_answer = "Disagree" THEN 1 END) AS C2,
      COUNT( CASE WHEN sv_answer = "No Opinion" THEN 1 END) AS C3,
      COUNT( CASE WHEN sv_answer = "Agree" THEN 1 END) AS C4,
      COUNT( CASE WHEN sv_answer = "Strongly Agree" THEN 1 END) AS C5,
      lesson_id, question_name'))
      ->groupBy('question_name', 'lesson_id')
      ->get();

      /*
      $survey_data = DB::select('SELECT
        COUNT( CASE WHEN sv_answer = "Strongly Disagree" THEN 1 END) AS C1,
        COUNT( CASE WHEN sv_answer = "Disagree" THEN 1 END) AS C2,
        COUNT( CASE WHEN sv_answer = "No Opinion" THEN 1 END) AS C3,
        COUNT( CASE WHEN sv_answer = "Agree" THEN 1 END) AS C4,
        COUNT( CASE WHEN sv_answer = "Strongly Agree" THEN 1 END) AS C5,
        lesson_id, question_name
      FROM
        survey_data
      LEFT JOIN lessons AS l ON l.id = survey_data.lesson_id
      WHERE lesson_id = ' . $lesson_id . '
      GROUP BY
        question_name,
        lesson_id');*/
      $survey_collection = SurveyData::where('lesson_id', $lesson_id)->leftJoin('users', 'users.id', '=', 'survey_data.student_id')->whereIn('survey_data.student_id', $student['student_lists'])->whereBetween('survey_data.created_at', [$start_date, $end_date])->get();
      $result = [];
      foreach($survey_collection as $survey) {
        $result[$survey['question_name']][$survey['sv_answer']] = array();
      }
      foreach($survey_collection as $survey) {
        if (!in_array($survey['name'], $result[$survey['question_name']][$survey['sv_answer']])) {
          array_push($result[$survey['question_name']][$survey['sv_answer']], $survey['name']);
        }
      }
      $data = array();
      $data['survey_data'] = $survey_data;
      $data['student_data'] = $result;
      return $data;
    }
    public function getAjaxLessons(Request $request) {
      $user = Auth::user();

      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // Rows display per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value']; // Search value
      $checked = $request->get('checked');
      $checked_id = $request->get('checked_id');
      $resource_checked = $request->get('resource_checked');
      $resource_checked_id = $request->get('resource_checked_id');
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value']; // Search value

      $totalRecords = Lesson::count();
      $records = Lesson::where('id', '!=', NULL);
      $totalRecordswithFilter = 0;

      if ($searchValue != ''){
            $records = $records->where(function($query) use ($searchValue) {
                $query->orWhere('name', 'LIKE', "%{$searchValue}%")
                ->orWhere('description', 'LIKE', "%{$searchValue}%");
            });
        }

      /*$records = $records->skip($start)
      ->take($rowperpage)
      ->get();*/

      $records = $records->get();

      $data_arr = array();
      foreach($records as $record) {
          $grade_level = $record->grade_levels;
          $grade_level = $grade_level[0];
          $resource_type = $record->resource_type_id;
          $resource_type = intval($resource_type);
          //$grade_level = substr($grade_level, 0, 1);
          //$grade_level = intval($grade_level);

          $flag = 0;
          for($i = 0; $i < count($resource_checked); $i ++)
          {
            if($resource_checked_id[$i] == $resource_type && $resource_checked[$i] == 1)
            {
              $flag = 1;
            }
          }
          $flag1 = 0;
          for($i = 0; $i < count($checked); $i ++)
          {
            if($checked_id[$i] == $grade_level && $checked[$i] == 1)
            {
              $flag1 = 1;
            }
          }
          if($flag1 == 1 && $flag == 1)
          {
            $data_arr[] = array(
                'image_url' => $record->image_url,
                'name' => $record->name,
                'description' => $record->description,
                'id' => $record->id,
                'invite_urls' => $this->generateRandomString(5) . $user->id . 'Z' . $this->generateRandomString(5) . $record->id,
            );
            $totalRecordswithFilter ++;
          }
      }
      $data_arr1 = array();
      $end = $start + $rowperpage;
      if($totalRecordswithFilter < $end)
      {
        $end = $totalRecordswithFilter;
      }
      for($i = $start; $i < $end; $i ++)
      {
        $data_arr1[] = array(
                'image_url' => $data_arr[$i]['image_url'],
                'name' => $data_arr[$i]['name'],
                'description' => $data_arr[$i]['description'],
                'id' => $data_arr[$i]['id'],
                'invite_urls' => $data_arr[$i]['invite_urls'],
            );
      }
      $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr1
      );
      echo json_encode($response);
    }

    public function selectClass($id)
    {
      $class = SchoolClass::find($id);
      Session::put('selectedClass', $class);
      return \redirect()->back();
    }

    public function changePassword() {
      $user = Auth::user();
      $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();
      return view('teacher.changePassword', compact('classes'));
    }

    public function activityHelp(Request $request) {
      $student_id = $request->s_id;
      $teacher_id = $request->t_id;
      $lid = $request->lid;
      $act_data = ActivityHelp::where('ah_sid', $student_id)->where('ah_lid', $lid)->where('ah_status', 0)
      ->where(function($query) use ($teacher_id) {
        $query->orWhere('ah_tid', $teacher_id)
        ->orWhere('ah_tid', $teacher_id);
      })->first();

      if (empty($act_data)) {
        return;
      }

      $status = $request->status;
      ActivityHelp::where('ah_tid', $teacher_id)->where('ah_sid', $student_id)->update(['ah_status' => $status]);
      return 1;
    }

    public function addActivity(Request $request) {
      $lid = $request->lid;
      $student_id = $request->s_id;
      $user_info = DB::table('users')->where('id', $student_id)->first();

      //$teacher_id = $user_info->parent_user_id;
      //$teacher_id = 27;
      //$act_data = ActivityHelp::where('ah_tid', $teacher_id)->where('ah_sid', $student_id)->where('ah_lid', $lid)->where('ah_status', 0)->first();
      $data = array(
        'ah_tid'    =>  0,
        'ah_sid'    =>  $student_id,
        'ah_status' =>  0,
        'ah_lid'    =>  $lid,
        'ah_date'   =>  date('Y-m-d'),
        'learn'     =>  !empty($request->learn) ? $request->learn : 0,
        'vote'      =>  !empty($request->vote) ? $request->vote : '',
        'comment'   =>  !empty($request->comment) ? $request->comment : '',
      );
      //if (empty($act_data)) {
        ActivityHelp::create($data);
      //} else {
      //  ActivityHelp::where('ah_tid', $teacher_id)->where('ah_sid', $student_id)->where('ah_lid', $lid)->update($data);
      //}
      return 0;
    }


    public function updateActivityHelp(Request $request) {
      $lid = $request->lid;
      $tid = $request->tid;
      $sid = $request->sid;
      $activity = ActivityHelp::where('ah_sid', $sid)->where('ah_lid', $lid)->where('ah_status', 0)->orderBy('ah_id', 'desc')->first();
      $activity['ah_tid'] = $tid;
      $activity->save();
      return 1;
    }




    public function updatePassword(Request $request) {
      $user = Auth::user();
      if (empty($user) || !Hash::check($request->currentPassword, $user->password)) {
        return Redirect::back()->withErrors(['The current password is incorrect, please try again']);
      }
      $user->password = Hash::make($request->newPassword);
      $user->save();
      return Redirect::route('teacher')->with('msg', 'Your Password has successfully changed');
    }
    public function principalChangePassword() {
      $user = Auth::user();
      // $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();
      return view('principal.changePassword', compact('user'));
    }

    public function principalUpdatePassword(Request $request) {
      $user = Auth::user();
      if (empty($user) || !Hash::check($request->currentPassword, $user->password)) {
        return Redirect::back()->withErrors(['The current password is incorrect, please try again']);
      }
      $user->password = Hash::make($request->newPassword);
      $user->save();
      return Redirect::route('principal')->with('msg', 'Your Password has successfully changed');
    }

    public function getUserInfo()
    {
      return Auth::user();
    }

    public function getActiveLessonId()
    {
      $user = Auth::user();
      //$user['lesson_id'] = Session::get('lesson_id');
      if (empty($user)) {
        $user['user_type'] = 4;
        $user['lesson_id'] = Session::get('lesson_id');
        $user['id'] = Session::get('user_id');
        $user['name'] = Session::get('user_name');
      } else {
        $user['lesson_id'] = Session::get('lesson_id');
      }
      return $user;
    }

    public function principal(Request $request)
    {
        $user = Auth::user();
        $schools = null;
        if($request->has('district_id')){
            $schools = SchoolDistrict::where('district', $request->district_id)->get();
        }
        if($request->has('school_id')){
            $schools = SchoolDistrict::findOrFail($request->school_id);
        }
        $aQvars = $request->query();
        if($user->is_admin){
            $aRows = User::teacher()
                ->where(function($query) use ($request) {
                    if($request->has('district_id')){
                        $query->where('district', $request->district_id);
                    }
                    if($request->has('school_id')){
                        $query->where('school_district', $request->school_id);
                    }
                })
                ->paginate(10);
        }else {
            $aRows = User::teacher()->where('school_district', $user->school_district)->paginate(10);
        }
        $districts = District::where('status',1)->get();

        $students = User::get()->where('user_type','=',UserRole::STUDENT)->where('parent_user_id','=',Auth::user()->id);

        return view('principal.index', compact('user','aRows', 'districts', 'schools', 'students'));
    }
    public function userlogout(Request $request)
    {
      Auth::logout();
      return redirect('/login');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



   if(Auth::user()->user_type == UserRole::ADMIN) {

         return redirect('/admin/home');
      }
      if(Auth::user()->user_type == UserRole::PRINCIPAL){
          return redirect('/principal/home');
        Auth::user()->user_type ;

      }
      if(Auth::user()->user_type == UserRole::TEACHER){
          return redirect('/teacher/home');

      }
      if(Auth::user()->user_type == UserRole::STUDENT){
          return redirect('/student/home');
      }

         if(Auth::user()->user_type == 'admin') {
                $districts=DB::table('districts')->where('status',1)->get();
            return view('admin.addprinciple',compact('districts'));
        }else{
            return 'Sorry You are not authorized ';
        }


    }

      public function get_school_dist(Request $req)
    {
        $id=$req->department;
        $districts=DB::table('school_district')->where('district',$id)->where('status',1)->get();

        $html='<option>--Select School Name --</option>';
        foreach($districts as $districts){
            $html .='<option value="'.$districts->id.'">'.$districts->school.'</option>';
        }



        return $html;
    }

    public function homepage() {
        return view('index');
    }

    public function features() {
        return view('features');
    }

    public function pricing() {
        return view('pricing');
    }

    public function solutions()
    {
      return view('solutions');
    }

    public function about()
    {
      return view('about');
    }

    public function howto() {
        return view('howto');
    }

    public function contact()
    {
      // Contact::truncate();
      $user = Auth::user();
      return view('contact', compact('user'));
    }

    public function submitContact(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required',
        'title' => 'required',
        'district_name' => 'required',
        'school_name' => 'required',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'tyon' => 'required',
      ], [
        'tyon.required' => 'Type of Assessment Needed field is required.'
      ]);
      $contact = new Contact();
      $contact->addNew($request->toArray());

      $reveice_email = 'mshah@upliftk12.com';
      $subject = "New contact from ".$request->title." ".$request->name." via UpLiftK12";
      $blade = 'emails.contact';
      $data['name'] = $request->name;
      $data['title'] = $request->title;
      $data['district_name'] = $request->district_name;
      $data['school_name'] = $request->school_name;
      $data['phone'] = $request->phone;
      $data['email'] = $request->email;
      $data['tyon'] = $request->tyon;
      try {
        // Mail::to($reveice_email)->send(new SendMailContact($request->toArray()));
        $return = app('App\Http\Controllers\MailerController')->composeEmail($request->email,$subject,$blade,$data);
        return redirect()->back()->with('success','Success');
      }catch( \Exception $e ) {
          return redirect()->back();
      }

    }

    public function captivate()
    {
      $aRows = QuizData::all();
      // $aRows2 = Course::whereNotNull('data->data_user')->get();
      // dd($aRows2);
      return view('captivate', compact('aRows'));
    }

    /* nodejs blade */
    public function teachernodejs()
    {
      return view('teacher.nodejs');
    }

    public function studentnodejs()
    {
      return view('student.nodejs');
    }

    public function lessons()
    {
      $user = Auth::user();
      $lesson_ids = Invite::getLessons($user->id);
      $lessons = DB::table('lessons')->whereIn('id', $lesson_ids)->get();
      //var_dump($lessons);
      return view('student.lessons', compact('user', 'lessons'));
    }

    public function lessonStart($id, $mod)
    {
      $lesson_id = $id;
      /*$strings = explode('Z', $id);
      $lesson_id = substr($strings[1], 5);
      $lesson = Lesson::findOrFail($lesson_id);
      Session::put('lesson_id', $lesson_id);*/
      //$user = Auth::user();
      $mod = $mod;
      return view('student.trialLesson', compact('lesson_id', 'mod'));
    }

    public function premiumStart($id, $mod)
    {
        $strings = explode('Z', $id);
        $lesson_id = substr($strings[1], 5);
        $teacher_id = substr($strings[0], 5);
        $lesson = Lesson::findOrFail($lesson_id);
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->name;
        $lid = $teacher_id . '0000' . $lesson_id;
        $isVideo = $mod - 1;
        Session::put('lesson_id', $lid);
        $num =  (ord ($user_name) + strlen($user_name)) % 14 + 1;
        $activity = ActivityHelp::where('ah_lid', $lid)->orderBy('ah_id', 'desc')->first();
        $student_avatar = 'robot-' . $num;
        return view('student.activity-lesson', compact('lesson', 'user_name', 'user', 'user_id', 'lid', 'isVideo', 'student_avatar', 'lesson_id', 'activity'));
  }


    public function premiumStartQuiz($id, $mod, $invite_id)
    {
        $strings = explode('Z', $id);
        $lesson_id = substr($strings[1], 5);
        $teacher_id = substr($strings[0], 5);
        $lesson = Lesson::findOrFail($lesson_id);
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->name;
        $lid = $teacher_id . '0000' . $lesson_id;
        $isVideo = $mod - 1;
        Session::put('lesson_id', $lid);
        $num =  (ord ($user_name) + strlen($user_name)) % 14 + 1;
        $student_avatar = 'robot-' . $num;
        return view('student.lessonStartQuiz', compact('lesson', 'user_name', 'user_id', 'lid', 'isVideo', 'student_avatar', 'invite_id'));
    }

    public function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    public function lessonSingle($id)
    {
      $user = Auth::user();
      $lesson = Lesson::findOrFail($id);
      return view('student.lesson-single', compact('user', 'lesson'));
    }

    public function starttriallesson(Request $request) {
      $strings = explode('Z', $request->lessonid);
      $lesson_id = substr($strings[1], 5);
      $teacher_id = substr($strings[0], 5);
      $lesson = Lesson::findOrFail($lesson_id);
      $user_id = md5($request->student_name);
      $user_name = $request->student_name;
      Session::put('user_name', $user_name);
      Session::put('user_id', $user_id);
      $lid = $teacher_id . '0000' . $lesson_id;
      Session::put('lesson_id', $lid);
      $isVideo = $request->mod - 1;
      $num =  (ord ($request->student_name) + strlen($request->student_name)) % 14 + 1;
      $student_avatar = 'robot-' . $num . '.png';
      return view('student.lessonStart', compact('lesson', 'user_name', 'user_id', 'lid', 'isVideo', 'student_avatar'));
    }

    public function updateProfile(Request $request) {
/*
      $rules = array(
        'name'                  =>  'required',
        'new_password'          =>  'min:6|required_with:re_password|same:re_password',
        're_password'           =>  'required|min:6',
        'cur_password'          =>  'required',
      );
      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        return Redirect::back()
            ->withErrors($validator)->withInput($request->all());

      } else {
          $data = array(
              'name'              =>  $request->name,
              'password'          =>  $request->new_password,
          );
          $user = Auth::user();
          if(Hash::check($request->cur_password, $user->password)) {*/
            $user = Auth::user();
            $user->name = $request->name;
            //$user->password = Hash::make($request->new_password);
            if ($request->has('avatar') && isset($request->avatar)) {
              $image_avatar = $request->avatar;
              $user_image = time() . 'avatar.' . $image_avatar->getClientOriginalExtension();
              $imageName = 'public/assets/images/teachers/' . $user_image;

              if(File::exists($imageName)) {
                  File::delete($imageName);
              }

              $image_avatar->move('public/assets/images/teachers/', $user_image);
              $data['avatar'] = $imageName;
              $user->avatar = $imageName;
            }
            $user->save();/*
            return Redirect::back()->with('msg', 'Your profile data is changed successfully');
          } else {*/
            return Redirect::back()->with('msg', 'Your profile  has changed successfully');
          //}
      //}
    }

    public function profile() {
      $user = Auth::user();
      $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();

      return view('teacher.profile', compact('user', 'classes'));
    }

    public function freeTrial()
    {
      $districts = District::where('status',1)->get();
      return view('free-trial');
    }

    function randomName() {
      $firstname = array(
          'Johnathon',
          'Anthony',
          'Erasmo',
          'Raleigh',
          'Nancie',
          'Tama',
          'Camellia',
          'Augustine',
          'Christeen',
          'Luz',
          'Diego',
          'Lyndia',
          'Thomas',
          'Georgianna',
          'Leigha',
          'Alejandro',
          'Marquis',
          'Joan',
          'Stephania',
          'Elroy',
          'Zonia',
          'Buffy',
          'Sharie',
          'Blythe',
          'Gaylene',
          'Elida',
          'Randy',
          'Margarete',
          'Margarett',
          'Dion',
          'Tomi',
          'Arden',
          'Clora',
          'Laine',
          'Becki',
          'Margherita',
          'Bong',
          'Jeanice',
          'Qiana',
          'Lawanda',
          'Rebecka',
          'Maribel',
          'Tami',
          'Yuri',
          'Michele',
          'Rubi',
          'Larisa',
          'Lloyd',
          'Tyisha',
          'Samatha',
      );

      $lastname = array(
          'Mischke',
          'Serna',
          'Pingree',
          'Mcnaught',
          'Pepper',
          'Schildgen',
          'Mongold',
          'Wrona',
          'Geddes',
          'Lanz',
          'Fetzer',
          'Schroeder',
          'Block',
          'Mayoral',
          'Fleishman',
          'Roberie',
          'Latson',
          'Lupo',
          'Motsinger',
          'Drews',
          'Coby',
          'Redner',
          'Culton',
          'Howe',
          'Stoval',
          'Michaud',
          'Mote',
          'Menjivar',
          'Wiers',
          'Paris',
          'Grisby',
          'Noren',
          'Damron',
          'Kazmierczak',
          'Haslett',
          'Guillemette',
          'Buresh',
          'Center',
          'Kucera',
          'Catt',
          'Badon',
          'Grumbles',
          'Antes',
          'Byron',
          'Volkman',
          'Klemp',
          'Pekar',
          'Pecora',
          'Schewe',
          'Ramage',
      );

      $name = $firstname[rand ( 0 , count($firstname) -1)];
      $name .= ' ';
      $name .= $lastname[rand ( 0 , count($lastname) -1)];

      return $name;
  }

    function generate_emails($number, $username_length) {
      if (is_numeric($number) && $number != 0) {
        if ($number > 1000) { //put hard limit on generate request
          $number = 1000;
        }
        $user_list = array();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //$char_count = count($characters);
        $tld = array("com", "net", "biz");
        $servername = array("gmail", "outlook", "yahoo", "hotmail");
        for ($i=0; $i<$number; $i++) {
          $name = $this->randomName();
          $randomName = '';
          for($j=0; $j<$username_length; $j++){
            $randomName .= $characters[rand(0, strlen($characters) -1)];
          }
          $k = array_rand($tld);
          $extension = $tld[$k];

          $fullAddress = $name . $randomName . $i . "@" .$servername[rand() % 4]. '.' .$extension;
          $user = array(
            'name'              =>  ucwords($name, ' '),
            'parent_user_id'    =>  0,
            'student_id'        =>  '',
            'mdl_UserID'        =>  0,
            'mname'             =>  explode(' ', $name)[0],
            'lname'             =>  explode(' ', $name)[1],
            'username'          =>  $name . $randomName,
            'email'             =>  str_replace(' ', '', $fullAddress),
            'email_verified_at' =>  Carbon::now(),
            'password'          =>  Hash::make(str_replace(' ', '', ucwords($name, ' '))),
            'user_type'         =>  3,
            'state'             =>  '',
            'district'          =>  '',
            'shool_district'    =>  '',
            'remember_token'    =>  '',
            'avatar'            =>  ''
          );
          $user_info = User::create($user);
          $user['user_id'] = $user_info->id;
          $user['lesson_link'] = $this->generateRandomString(5) . $user['user_id'] . 'Z' . $this->generateRandomString(5) . '33';
          $user_list[] = $user;
          }
        }
        $fp = fopen("emails.csv", "w");
        fputcsv($fp, array('Teacher ID', 'Teacher Email', 'Teacher Password', 'Lesson Link'));
        foreach ($user_list as $user) {
          fputcsv($fp, array($user[user_id], $user['email'], str_replace(' ', '', ucwords($user['name'], ' ')), $user['lesson_link']));
        }
        fclose($fp);
    }
    public function generateTeachers() {
      $this->generate_emails(1000, 4);
    }

    public function writeCSV() {
      $row = 1;
      $teachers = array();
      if (($handle = fopen("emails.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            if ($row > 2) {
              $data[$num - 1] = "https://upliftk12.com/student/lesson/start/" . $this->generateRandomString(5) . $data[0] . 'Z' . $this->generateRandomString(5) . '33' . '/1';
              $teachers[] = $data;
            }
        }
        fclose($handle);
      }
      $fp = fopen("emails1.csv", "w");
      fputcsv($fp, array('Teacher ID', 'Teacher Email', 'Teacher Password', 'Lesson Link'));
      foreach ($teachers as $teacher) {
        fputcsv($fp, $teacher);
      }
      fclose($fp);
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
       'g-recaptcha-response' => 'required|recaptcha'
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
      $user->parent_user_id = -1;
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
        // Mail::to($user->email)->send(new SendMailActivate(['url' => $url, 'username' => $request->username]));
        $blade = "emails.activate";
        $data['url'] = $url;
        $data['username'] = $request->username;
        $subject = 'Activate your free trial';
        $return = app('App\Http\Controllers\MailerController')->composeEmail($request->email,$subject,$blade,$data);
        return redirect()->back()->with('success','Your registration was successful. Please check your email to activate your account.');
      }else {
        $errors = new \Illuminate\Support\MessageBag();
        // add your error messages:
        $errors->add('err', 'Error!');
        return redirect()->back()->withErrors($errors);
      }
    }

    public function teacherActivation(Request $request, $token)
    {

      $check = DB::table('user_activations')->where('token', $token)->first();
      if(!is_null($check)){
        $user = User::find($check->user_id);
        if ($user->email_verified_at != null){
            // Auth::loginUsingId($user->id);
            $request->session()->flash('success', 'You account activation was successful. Login at the top right to get started!');
            return view('activation')->with('success', "You account activation was successful. Login at the top right to get started!");
        }
        // $user->update(['email_verified_at' => Carbon::now()]);
        $user->email_verified_at = Carbon::now();
        $user->save();
        DB::table('user_activations')->where('token', $token)->delete();
        // Auth::loginUsingId($user->id);
        $request->session()->flash('success', 'You account activation was successful. Login at the top right to get started!');
        return view('activation')->with('success', "You account activation was successful. Login at the top right to get started!");
      }
      $request->session()->flash('error', 'Not Found.');
      return view('activation');
    }

    public function newsletter(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'g-recaptcha-response' => 'required|recaptcha'
      ], [
        'email.required'   =>  'The Email is required',
        'g-recaptcha-response.required' => 'Please complete the captcha'
      ]);

      if($validator->fails()){
        return response()->json([
          'status' => 'error',
          'message' => $validator->errors()->first()
        ]);
      }

      // $demo = new GetDemo();
      // $demo->name = $request->name;dd($demo);

      $demo_request = new DemoRequest;
      $demo_request->name = $request->name;
      $demo_request->email = $request->email;
      $demo_request->save();

      // Mail::to($request->email)->send($demo);
      $data['name'] = $request->name;
      $subject = "Did you request a demo?";
      $blade = "emails.getdemo_new";

      $return = app('App\Http\Controllers\MailerController')->composeEmail($request->email,$subject,$blade,$data);
      return response()->json([
        'status' => 'success',
        'message' => 'Please check your email for our calendar link'
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

    public function update_payment_method()
    {
        $user = Auth::user();
        $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();

        if((!Session::get('selectedClass')) && count($classes) > 0)
            Session::put('selectedClass', $classes[0]);

        $empty_class = SchoolClass::first();
        if($user->teacher_signup || count($classes) == 0) {
            Session::put('selectedClass', $empty_class);
        }
        return view('update-payment-method', compact('user', 'classes'));
    }

    public function orderPost(Request $request)
    {
        $user = auth()->user();
        $input = $request->all();
        $token =  $request->stripeToken;
        $paymentMethod = $request->paymentMethod;
        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if (is_null($user->stripe_id)) {
                $stripeCustomer = $user->createAsStripeCustomer();
            }

            \Stripe\Customer::createSource(
                $user->stripe_id,
                ['source' => $token]
            );

            $user->newSubscription('educator',$input['plane'])
                ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

            if($user->teacher_signup) {
                $user->teacher_signup->delete();
            }

            return back()->with('success','Subscription is completed.');
        } catch (Exception $e) {
            return back()->with('success',$e->getMessage());
        }
    }

    public function subscribed() {
        $user = auth()->user();
        if($user->subscribed('test')) {
            return 'true';
        }
        return 'false';
    }

    public function cancel_membership() {
        $user = Auth::user();
        $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();

        if($user->subscription('educator')->onGracePeriod()) {
            return view('teacher.onlythismonth', compact('user', 'classes'));
        }

        return view('teacher.unsubscribe', compact('user', 'classes'));
    }

    public function postCancel_membership(Request $request) {
        $this->validate($request, [
            'type' => 'required',
            'reason' => 'required',
        ]);

        $user = Auth::user();

        $tt = new CancelReason;
        $tt->type = $request->type;
        $tt->reason = $request->reason;
        $tt->user_id = $user->id;
        $tt->save();

        $user->subscription('educator')->cancel();

        return \redirect()->back();
    }

    public function forgetPage(){
      return view('forget_password');
    }

    public function sendLink(Request $request){
     $user = DB::table('users')->where('email', '=', $request->email)
    ->first();
    if ($user == "") {
      return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
    }
      DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => str_random(60),
        'created_at' => Carbon::now()
      ]);
      $tokenData = DB::table('password_resets')
      ->where('email', $request->email)->first();
      $data['to']=$request->email;
      $data['subject'] = "Customer Reset Password";
      $data['from'] = "";
      $blade = "emails.forget_password";
      if ($this->sendResetEmail($request->email, $tokenData->token)) {
        return redirect()->back()->with('msg', trans('A reset link has been sent to your email address.'));
      } else {
          return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
      }


    }
    private function sendResetEmail($email, $token)
    {
      $data['to']=$email;
      $data['subject'] = "Forget Password Link";
      $data['from'] = "";
      $blade = "emails.forget_password";
      $user = DB::table('users')->where('email', $email)->first();
      $link = url('/') . '/password_reset/' . $token . '/' . urlencode($user->email);
      $data['link'] = $link;
      $to = $email;
      $subject = 'Forget Password Link';


       try {
        // Mail::send(['html'=>$blade],$data, function($message) use ($data) {
        //   $message->to($data['to'])->subject($data['subject']);

        // });
        $return = app('App\Http\Controllers\MailerController')->composeEmail($to,$subject,$blade,$data);
            return $return;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function passwordReset($token,$email){
      return view('reset_password',compact('token','email'));
    }
    public function resetPassword(Request $request){
      $validatedData = $request->validate([
        'email' => 'required|email|exists:users,email',
        'newPassword' => 'required|required_with:password_confirmation',
        'token' => 'required'
      ]);
      $password = $request->password;
      $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
      if (!$tokenData) return redirect()->back();
      $user = User::where('email', $tokenData->email)->first();
      if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
      DB::table('password_resets')->where('email', $user->email)
    ->delete();//dd(Hash::make($request->newPassword));
      $user->password = Hash::make($request->newPassword);
      $user->save();
      return redirect('/login')->with('msg','Password reset successfully');
    }

    public function updateActivityFix(Request $request)
    {
        $s_id = $request->s_id;
        $lid = $request->lid;
        $learn = $request->learn;
        $vote = $request->vote;
        $comment = $request->comment;

        $act_data = ActivityHelp::where('ah_sid', $s_id)->where('ah_lid', $lid)->where('ah_status', 0)->orderBy('ah_id','DESC')->first();

        if (empty($act_data)) {
            return;
        }

        ActivityHelp::where('ah_sid', $s_id)->where('ah_lid', $lid)->orderBy('ah_id','DESC')->first()->update(['learn' => $learn, 'vote' => $vote, 'comment' => $comment]);
        return 1;
    }


}
