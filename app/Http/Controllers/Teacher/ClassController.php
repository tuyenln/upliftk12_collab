<?php
namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\QuizData;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\SpeechWord;
use App\PlacementTest;
use App\Assessment;
use App\SchoolClass;
use App\Subject;
use App\User;
use App\GradeLevel;
use App\Lesson;
use App\Note;
use App\Invite;
use App\Role\UserRole;
use App\District;
use Illuminate\Support\Facades\Hash;
use DOMPDF;
use Validator;
use Session;
use Carbon\Carbon;

class ClassController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $aRows = SchoolClass::where('teacher_id',Auth::user()->id)->distinct()->get();
        return view('teacher.list',compact('aRows'));
    }

    public function manageClass(Request $request) {
        $aRows = SchoolClass::where('teacher_id',Auth::user()->id)->distinct()->orderby('id', 'desc')->get();
        $classes = SchoolClass::where('teacher_id', '=', Auth::user()->id)->orderby('id', 'desc')->get();
        return view('teacher.manageClass',compact('aRows', 'classes'));
    }

    public function addClass(Request $request) {
        $aRow = array();
        $classes = SchoolClass::where('teacher_id', '=', Auth::user()->id)->orderby('id', 'desc')->get();
        $aSubjects = Subject::get()->pluck('name', 'id')->toArray();
        $aGradeLevels = GradeLevel::get()->pluck('name', 'id')->toArray();
        return view('teacher.add-class',compact('aRow','aSubjects','aGradeLevels', 'classes'));
    }

    public function create()
    {
        $aRow = array();
        $aSubjects = Subject::get()->pluck('name', 'id')->toArray();
        $aGradeLevels = GradeLevel::get()->pluck('name', 'id')->toArray();
        return view('teacher.add',compact('aRow','aSubjects','aGradeLevels'));
    }
    public function store(Request $request)
    {

       $school_id = Auth::user()->school_district;
        $this->validate($request, [
             //'name' => 'required|string|max:255|unique:classes',
              'name' => 'required|string|max:255|unique:classes,name,NULL,id,school_id,'.$school_id
        ]);

        $aRows = $this->preparevalue($request->all());

        SchoolClass::create($aRows);
        return redirect('teacher/manageClass')->with('message', 'New Class Added Successfully.');
    }

    public function edit($id)
    {
        $aRow = SchoolClass::findOrFail($id);
        $classes = SchoolClass::where('teacher_id', '=', Auth::user()->id)->orderby('id', 'desc')->get();
        $aSubjects = Subject::get()->pluck('name', 'id')->toArray();
        $aGradeLevels = GradeLevel::get()->pluck('name', 'id')->toArray();
        return view('teacher.edit-class',compact('aRow','aSubjects','aGradeLevels', 'classes'));
    }


    public function update(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
             'name' => 'required|string|max:255|unique:classes,name,'.$id,
        ]);

        $aRow = SchoolClass::find($id);
        $aVals = $this->preparevalue($aVals,$id);
        $aRow->update($aVals);


        return redirect('teacher/manageClass')->with('message', 'Class updated Successfully.');
    }

    public function destroy($id)
    {
        $aRow = SchoolClass::findOrFail($id);
        $aRow->delete();
        return redirect('teacher/manageClass')->with('message', 'Class deleted Successfully.');
    }

    private function preparevalue($aRows,$aID = 0)
    {
    	$aUser = array();
       	$aUser['name'] = $aRows['name'];
    	$aUser['subject_id'] = $aRows['subject_id'];
    	$aUser['grade_level_id'] = $aRows['grade_level_id'] ?? '';
    	$aUser['school_id'] = Auth::user()->school_district ? Auth::user()->school_district : 0;
        $aUser['teacher_id'] = Auth::user()->id;
    	return $aUser;
    }

    public function managestudent($aClassId,Request $request)
    {
        $user = Auth::user();
        $aClass = SchoolClass::where('id','=',$aClassId)->first();
        // get principal of school
        $principal = User::where('user_type','=',UserRole::PRINCIPAL)->where('school_district', $user->school_district)->first();
        $student_lists = $aClass->student_lists;
        $student_lists_array = $student_lists ?? array();

        if($request->all())
        {
            $aVals = $request->all();
            $post_student_list = $aVals['student_list'];
            $all_students = array_merge($student_lists_array,$post_student_list);
            $integerIDs = array_map('intval', $all_students);
            // $aRow = SchoolClass::find($aClassId);
            // $aClass->update($aInsert);
            $aClass->student_lists = $integerIDs;
            $aClass->save();
            Session::put('selectedClass', $aClass);
            return redirect("teacher/manage/student/{$aClassId}")->with('message', 'Student Added Successfully.');

        }
        else {

            $aStudents = User::where('user_type', '=', UserRole::STUDENT)->where('parent_user_id', $principal->id)->whereNotIn('id', $student_lists_array)->get();
            $aStudentLists = $aClass->students();

            $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();
        }

        return view('teacher.add-student',compact('aStudents','aClassId','aStudentLists', 'aClass', 'classes'));
    }

    public function deletestudent($aClassId,$sId)
    {
        SchoolClass::deleteStudent($aClassId,$sId);
        $aRow = SchoolClass::find($aClassId);
        Session::put('selectedClass', $aRow);
        return redirect("teacher/manage/student/{$aClassId}")->with('message', 'Student deleted Successfully.');

    }

    public function printroster($aType,$aClassId)
    {
        $aClass = SchoolClass::where('id','=',$aClassId)->first();
        $student_lists = $aClass->student_lists;
        $student_lists_array = $student_lists ?? array();
        $aStudentLists = User::get()->where('user_type','=',UserRole::STUDENT)->whereIn('id',$student_lists_array);
        if($aType == "pdf")
        {
            $pdf = DOMPDF::loadView('teacher.class.exportpdf', compact('aClass','aStudentLists'));
            return $pdf->download('student_list.pdf');
        }
        if($aType == "csv")
        {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="student_list.csv"');
            $fp = fopen('php://output', 'wb');
            if($aStudentLists)
            {
                $classname = array("Class :". $aClass->name);
                fputcsv($fp, $classname);
                fputcsv($fp, array(""));
                $header  = array("Go to","Click","Name","Last Name","Username","Password", "Link Login");
                fputcsv($fp, $header);
                 fputcsv($fp, array(""));
                foreach ($aStudentLists as $key => $aStudentList) {
                    $url = 'upliftk12.com/fastLogin/' . $aStudentList->username . '/' . $aStudentList->username;
                    $val = array('upliftk12.com',"upliftk12.com",$aStudentList->name,$aStudentList->lname, $aStudentList->username,$aStudentList->username, $url);
                    fputcsv($fp, $val);
                }
            }
            fclose($fp);
        }
    }

    //single class info
    public function info($id){
        $aClass = SchoolClass::findOrFail($id);
        return view('teacher.info', compact('aClass'));
    }

    //report class
    public function report(Request $request){

        $user = Auth::user();
        $aClass = false;
        $assessment = false;
        if($request->has('class'))
            $aClass = SchoolClass::findOrFail($request->class);
        if($request->has('assessment')){
            $assessment = Assessment::findOrFail($request->assessment);
            if(!$assessment) return abort(404);
        }
        $passage_id = null;
        if($assessment && $request->has('passage') && $request->passage != null){
            $passage_id = $request->passage-1 ?? 0;
            $passage = $assessment->passages[$passage_id] ?? null;
            if(!$passage) return abort(404);
        }
        return view('teacher.report-class', compact('user', 'aClass', 'assessment', 'passage_id'));
    }

    //singe placementDetail
    public function placementDetail($id){
        $user = Auth::user();
        $pl = PlacementTest::findOrFail($id);
        $student_id = $pl->user_id;
        $subject_id = $pl->assessment->subject;
        $student_class = SchoolClass::where('subject_id', $subject_id)
                ->whereJsonContains('student_lists', $student_id)
                ->first();
        return view('teacher.single-placement', compact('user', 'pl', 'student_class'));
    }

    //ajax
    public function updateScore(Request $request){
        $validator = Validator::make($request->all(), [
            'word_id' => 'required',
            'score' => 'required|min:1|max:100'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return array(
              'status' => 'error',
              'msg' => $error
            );
        }
        $word_id = $request->word_id;
        $word = SpeechWord::findOrFail($word_id);
        $word->score = $request->score;
        $word->save();
        return array(
            'status' => 'success',
            'msg' => 'Success'
        );
    }

    //ajax
    public function getAssessments(Request $request){
        $class_id = $request->class_id;
        $aClass = SchoolClass::findOrFail($class_id);
        $assessments = $aClass->assessments();
        $data = "";
        foreach($assessments as $asm){
            $data .= '<option value="'.$asm->id.'">'.$asm->name.'</option>';
        }
        return array(
          'status' => 'success',
          'data' => $data
        );
    }

    public function getStudents(Request $request){
        $class_id = $request->class_id;
        $aClass = SchoolClass::findOrFail($class_id);
        $students = $aClass->students();
        //print_r($students); exit;
        $data = "";
        foreach($students as $asm){
            //$data .= '<option value="'.$asm->id.'">'.$asm->name.'</option>';
            $data .= '<input type="checkbox" name="students" value="'.$asm->id.'"><label for="'.$asm->name.'"> '.$asm->name.'</label><br>';
        }
        return array(
          'status' => 'success',
          'data' => $data
        );
    }

    //ajax
    public function getPassages(Request $request){
        $asm_id = $request->asm_id;
        $asm = Assessment::findOrFail($asm_id);
        $passages = $asm->passages;
        $data = "";
        if($passages){
            foreach($passages as $key=>$pg){
                $passage_id = $key+1;
                $data .= '<option value="'.$passage_id.'">'.$pg['name'].'</option>';
            }
        }
        return array(
          'status' => 'success',
          'show_passage' => $passages ? true : false,
          'data' => $data
        );
    }


    public function mathreport(Request $request){
        $quiz_questions = [];
        $attempt_students = [];
        $data = [];
        if($request->has('quiz')){
            $courseid = 3;
            $quizid = $request->quiz;
            $quiz_questions_id = DB::connection('moodle')
                                ->table('mdl_quiz_slots')
                                ->where('quizid', $quizid)
                                ->pluck('questionid')->toArray();

            // get questions by quizid
            $quiz_questions = DB::connection('moodle')->table('mdl_question')
                                ->select('mdl_question.*', 'mdl_case_tbl.case_data')
                                ->join('mdl_quiz_slots', 'mdl_question.id', '=', 'mdl_quiz_slots.questionid')
                                ->join('mdl_case_tbl', 'mdl_question.id', '=', 'mdl_case_tbl.question_id')
                                ->where('mdl_quiz_slots.quizid', $quizid)
                                // ->groupBy('mdl_case_tbl.case_data')
                                ->get();
            // dump($quiz_questions);

            // get attempts by quizid
            $attempts = DB::connection('moodle')->table('mdl_quiz_attempts')
                                // ->select('mdl_question.*', 'mdl_case_tbl.case_data')
                                // ->join('mdl_quiz_slots', 'mdl_question.id', '=', 'mdl_quiz_slots.questionid')
                                // ->join('mdl_case_tbl', 'mdl_question.id', '=', 'mdl_case_tbl.question_id')
                                ->where('quiz', $quizid)
                                // ->where('userid', 25)
                                ->where('state', 'finished')
                                ->groupBy('userid')
                                ->get();
            // dd($attempts);

            // get user answer question
            $attempt_students = DB::connection('moodle')->table('mdl_quiz_attempts')
                            ->select('mdl_user.id','mdl_user.firstname', 'mdl_user.lastname')
                            ->join('mdl_user', 'mdl_quiz_attempts.userid', '=', 'mdl_user.id')
                            ->where('mdl_quiz_attempts.attempt', 1)
                            ->where('quiz', $quizid)
                            ->where('mdl_quiz_attempts.state', 'finished')
                            ->get();
            // dd($attempt_students);
            $data = DB::connection('moodle')->table('mdl_question_attempt_steps')
                                ->select('mdl_question_attempt_steps.*', 'mdl_question_attempts.questionid', 'mdl_case_tbl.case_data', 'mdl_user.firstname', 'mdl_user.lastname')
                                ->join('mdl_question_attempts', 'mdl_question_attempt_steps.questionattemptid', '=', 'mdl_question_attempts.id')
                                ->join('mdl_case_tbl', 'mdl_question_attempts.questionid', '=', 'mdl_case_tbl.question_id')
                                ->join('mdl_quiz_attempts', 'mdl_question_attempts.questionusageid', '=', 'mdl_quiz_attempts.uniqueid')
                                ->join('mdl_user', 'mdl_quiz_attempts.userid', '=', 'mdl_user.id')
                                ->where('mdl_quiz_attempts.attempt', 1)
                                ->where('mdl_quiz_attempts.quiz', $quizid)
                                // ->where('mdl_question_attempts.questionusageid', $attempt_unique)
                                // ->where('mdl_quiz_attempts.userid', 9)
                                ->whereIn('mdl_question_attempt_steps.state', ['gradedwrong', 'gradedright'])
                                // ->groupBy('mdl_question_attempt_steps.userid')
                                ->get();
            // dd($data, collect(json_decode($data))->groupBy('userid'));
        }
        $aGradeLevels = GradeLevel::get();

        return view('teacher.math-report', compact('user', 'aGradeLevels', 'attempt_students', 'quiz_questions', 'data'));
    }

    public function filter_students(Request $request) {

        if($request->has('quiz')){
            $quizid = $request->quiz;
            if($request->has('students')){
                $students = $request->students;
                $data = DB::connection('moodle')->table('mdl_question_attempt_steps')
                                ->select('mdl_question_attempt_steps.*', 'mdl_question_attempts.questionid', 'mdl_case_tbl.case_data', 'mdl_user.firstname', 'mdl_user.lastname')
                                ->join('mdl_question_attempts', 'mdl_question_attempt_steps.questionattemptid', '=', 'mdl_question_attempts.id')
                                ->join('mdl_case_tbl', 'mdl_question_attempts.questionid', '=', 'mdl_case_tbl.question_id')
                                ->join('mdl_quiz_attempts', 'mdl_question_attempts.questionusageid', '=', 'mdl_quiz_attempts.uniqueid')
                                ->join('mdl_user', 'mdl_quiz_attempts.userid', '=', 'mdl_user.id')
                                ->where('mdl_quiz_attempts.attempt', 1)
                                ->where('mdl_quiz_attempts.quiz', $quizid)
                                ->whereIn('mdl_user.id', $students)
                                ->whereIn('mdl_question_attempt_steps.state', ['gradedwrong', 'gradedright'])
                                ->get();
                if($data){
                    $view = view()->make('teacher.table_filter', ['data' => $data, 'type' => 'student']);
                    $output = (string) $view;
                }
                return response()->json($output);
            }
            if($request->has('objective')){
                $objective = $request->objective;
                $data = DB::connection('moodle')->table('mdl_question_attempt_steps')
                                ->select('mdl_question_attempt_steps.*', 'mdl_question_attempts.questionid', 'mdl_case_tbl.case_data', 'mdl_user.firstname', 'mdl_user.lastname')
                                ->join('mdl_question_attempts', 'mdl_question_attempt_steps.questionattemptid', '=', 'mdl_question_attempts.id')
                                ->join('mdl_case_tbl', 'mdl_question_attempts.questionid', '=', 'mdl_case_tbl.question_id')
                                ->join('mdl_quiz_attempts', 'mdl_question_attempts.questionusageid', '=', 'mdl_quiz_attempts.uniqueid')
                                ->join('mdl_user', 'mdl_quiz_attempts.userid', '=', 'mdl_user.id')
                                ->where('mdl_quiz_attempts.attempt', 1)
                                ->where('mdl_quiz_attempts.quiz', $quizid)
                                ->where('mdl_case_tbl.case_data', $objective)
                                ->whereIn('mdl_question_attempt_steps.state', ['gradedwrong', 'gradedright'])
                                ->get();
                if($data){
                    $view = view()->make('teacher.table_filter', ['data' => $data, 'type' => 'objective']);
                    $output = (string) $view;
                }
                return response()->json($output);
            }
        }
    }

    public function get_list_questions(Request $request) {

        $quizid = $request->quizid;
        $quiz_questions = DB::connection('moodle')->table('mdl_question')
                            ->select('mdl_question.*', 'mdl_case_tbl.case_data')
                            ->join('mdl_quiz_slots', 'mdl_question.id', '=', 'mdl_quiz_slots.questionid')
                            ->join('mdl_case_tbl', 'mdl_question.id', '=', 'mdl_case_tbl.question_id')
                            ->where('mdl_quiz_slots.quizid', $quizid)
                            // ->groupBy('mdl_case_tbl.case_data')
                            ->pluck('case_data')
                            ->toJson();
                            // dd($quiz_questions);
        return $quiz_questions;
    }
/* add new function*/


  public function enroll()
    {




        $aStudents = User::get()->where('user_type','=',UserRole::STUDENT);

        return view('teacher.enroll',compact('aStudents'));


       // return view('teacher.report-class', compact('user', 'aClass', 'assessment', 'passage_id'));
    }

    //lesson
    public function lesson(Request $request){
        $aQvars = $request->query();
        $aRows = Lesson::get();
        return view('teacher.lesson-list',compact('aRows'));
    }
    public function lessonDetail($id){
        $aRow = Lesson::findOrFail($id);
        return view('teacher.lesson-detail',compact('aRow'));
    }

    public function inviteStudents($invite_id, $is_add) {
        $user = Auth::user();

      if(Session::get('selectedClass')->student_lists)
        $students = Session::get('selectedClass')->students();
      else
        $students = [];

      $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();
      if($is_add == 1) {
          $lesson = Lesson::find($invite_id);
      }
      else {
          $invite = Invite::find($invite_id);
          $lesson = Lesson::find($invite->lesson_id);
      }


      return view('teacher.invite-students', compact('lesson', 'students', 'classes', 'user', 'invite_id','is_add'));
    }

    public function postInviteStudentszzz(Request $request, $lesson_id, $is_add) {
      $user = Auth::user();
      $invite = Invite::where('id', $lesson_id)->get();
      if(count($invite)) {
          $lesson = Lesson::find($invite[0]->lesson_id);
      }
      else {
          $lesson = Lesson::find($lesson_id);
      }
      if($request->students == null) {
          $request->students = [];
      }
      if($is_add == 0) {
          $invite[0]->students = $request->students;

          $olddate = \DateTime::createFromFormat('m-d-Y', $request->date);

          $invite[0]->start_date = $olddate->format('Y-m-d');
          $invite[0]->class_id = $request->class_id;
          $invite[0]->save();
      }
      else {
          $invite = new Invite;
          $invite->students = $request->students;
          $olddate = \DateTime::createFromFormat('m-d-Y', $request->date);
          $invite->start_date = $olddate->format('Y-m-d');
          $invite->teacher_id = $user->id;
          $invite->lesson_id = $lesson_id;
          $invite->class_id = $request->class_id;
          $invite->save();
      }



      $str = count($request->students) . (count($request->students)>1 ? ' students':' student') . ' invited to ' .$lesson->name;

      return redirect()->to('teacher')->with('invite_notify', $str);
    }

    public function postInviteStudents(Request $request, $lesson_id, $is_add) {
        $user = Auth::user();
        $invite = Invite::where('lesson_id', $lesson_id)->first();
        if($invite) {
            $lesson = Lesson::find($invite->lesson_id);
            $invite->students = $request->students;

            $olddate = \DateTime::createFromFormat('m-d-Y', $request->date);

            $invite->start_date = $olddate->format('Y-m-d');
            $invite->class_id = $request->class_id;
            $invite->update();
        }
        else {
            $lesson = Lesson::find($lesson_id);
            $invite = new Invite;
            $invite->students = $request->students;
            $olddate = \DateTime::createFromFormat('m-d-Y', $request->date);
            $invite->start_date = $olddate->format('Y-m-d');
            $invite->teacher_id = $user->id;
            $invite->lesson_id = $lesson_id;
            $invite->class_id = $request->class_id;
            $invite->save();
        }
        $str = "";
        if (!empty($request->students)) {
            $str = count($request->students) . (count($request->students)>1 ? ' students':' student') . ' invited to ' .$lesson->name;
        }


        return redirect()->to('teacher')->with('invite_notify', $str);
      }

    public function postClearInvites(Request $request) {
      $invite = Invite::find($request->lesson_id);
      $lesson_id = $invite->lesson_id;
      $invite->delete();
      $lesson = Lesson::find($lesson_id);
      return redirect()->to('teacher')->with('lesson_name', $lesson->name);
    }

    public function postHideInvite(Request $request) {
        $invite = Invite::find($request->lesson_id);
        $lesson_id = $invite->lesson_id;
        $invite->isHidden = 1;
        $invite->save();
        $lesson = Lesson::find($lesson_id);
        return redirect()->to('teacher')->with('lesson_name1', $lesson->name);
    }

    public function postShowInvite(Request $request) {
        $invite = Invite::find($request->lesson_id);
        $lesson_id = $invite->lesson_id;
        $invite->isHidden = 0;
        $invite->save();
        $lesson = Lesson::find($lesson_id);
        return redirect()->to('teacher')->with('lesson_name2', $lesson->name);
    }


    public function postRemoveInvite(Request $request) {
      $invite = Invite::where('lesson_id', $request->lesson_id)->where('teacher_id', Auth::user()->id)->first();
      $list = $invite->students;
      $list = array_diff( $list, array($request->student_id));
      $invite->students = $list;
      $invite->save();
      return redirect()->to('teacher');
    }

    public function readCalendar(Request $request) {
      $invites = Invite::where('teacher_id', Auth::user()->id)->where('start_date', '>', $request->start)->where('start_date', '<', $request->end)->get();
      $lessons = array();
      for($i = 0; $i < count($invites); $i++) {
          $lesson = Lesson::find($invites[$i]->lesson_id);
          $lesson['start_date'] = $invites[$i]->start_date;
          $lesson['invites'] = count($invites[$i]->students);
        $lessons[] = $lesson;
      }
      return $lessons;
    }


    public function postAddClass(Request $request) {
      $user = Auth::user();
      $class = new SchoolClass;
      $class->name = $request->name;
      $class->teacher_id = $user->id;
      $class->school_id = 5666;
      $class->subject_id = 4;
      $class->grade_level_id = 3;
      $class->student_lists = $request->students;
      $class->save();

      return redirect('teacher');
    }

    public function invite(Request $request) {
        $aRows = Invite::all();
        return view('teacher.invite-all',compact('aRows'));
    }

    public function destoryInvite($invite_id, $student_id)
    {

        // delete student from class
        $res = Invite::findOrFail($invite_id);
        if($res)
        {
            Invite::deleteStudent($res->id,$student_id);
        }
        return redirect('/teacher/invite');
    }

    public function destoryInviteLesson($invite_id) {
        $res = Invite::findorFail($invite_id);
        $res->delete();
        return \redirect()->back();
    }

    public function lessonStart($id, $mod)  {

        $strings = explode('Z', $id);
        $lesson_id = substr($strings[1], 5);
        $teacher_id = substr($strings[0], 5);

        $lesson = Lesson::findOrFail((int)$lesson_id);
        $note = Note::where('lesson_id', $lesson_id)->first();
        $user = Auth::user();
        $lid = $teacher_id . '0000' . $lesson_id;
        $isVideo = $mod - 1;
        Session::put('lesson_id', $lid);
        return view('teacher.lessonStart', compact('lesson', 'user', 'lid', 'isVideo', 'note'));
    }

    public function activtyHelpStart($id, $mod) {
        $strings = explode('Z', $id);
        $lid = substr($strings[1], 5);
        $teacher_id = substr($strings[0], 5);
        $lesson_id = explode('0000', $lid)[1];

        $lesson = Lesson::findOrFail((int)$lesson_id);
        $note = Note::where('lesson_id', $lesson_id)->first();
        $user = Auth::user();
        $isVideo = $mod - 1;
        Session::put('lesson_id', $lid);
        return view('teacher.activity-help', compact('lesson', 'user', 'lid', 'isVideo', 'note'));

    }

    public function addStudent(Request $request) {
        $user = Auth::user();
        $classes = SchoolClass::where('teacher_id', '=', $user->id)->get();
        $schools = null;
        if($request->has('district_id')){
            $schools = SchoolDistrict::where('district', $request->district_id)->get();
        }
        if($request->has('school_id')){
            $schools = SchoolDistrict::findOrFail($request->school_id);
        }
        $districts = District::where('status',1)->get();

        $students = User::get()->where('user_type','=',UserRole::STUDENT)->where('parent_user_id','=',Auth::user()->id);

        return view('teacher.manage-students', compact('user','districts', 'schools', 'students', 'classes'));
    }

    public function getQuizData(Request $request) {
      $quizs = QuizData::join('users', 'quiz_data.student_id', '=', 'users.id')
          ->where('quiz_data.invite_id', $request->invite_id)
          ->get();

      $lesson = Lesson::find(Invite::find($request->invite_id)->lesson_id);

      $str = '';

      foreach ($quizs as $quiz) {
          $report_data = '';
          if(($quiz->score * 1) <= 50) {
              $report_data = 'report_low';
          }
          else if(($quiz->score * 1) <= 75) {
              $report_data = 'report_medium';
          }
          else {
              $report_data = 'report_high';
          }
        $score = '<div style="width: ' . ($quiz->score * 1) . '%; margin-left: 0;" class="report">
                            <div class="' . $report_data .'"></div>
                        </div>';
          $score = $quiz->score . '%<div style="width: 50%; position: relative;" class="report">
                        <div class="report_nodata"></div>
                        <div style="position: absolute; top:0; left: 0; width: 100%;">'. $score .'</div>
                    </div>';
        $str .=
            '<tr class="report_student">
                <td class="cbox"><input type="checkbox" name="students[]" ><span class="checkbox-mark"></span></td>
                <td>' . $quiz->name . '</td>
                <td>' . $quiz->lname . '</td>
                <td> ' . $lesson->objective. '</td>
                <td style="position:relative;">
                    <div class="d-flex">'. $score .'</div>
                    <div class="dot-dropdown" style="top:5px; right:20px;">
                        <div class="dropdown">
                            <i class="fa fa-ellipsis-v dropdown-toggle"
                               data-toggle="dropdown" style="color: black;" aria-hidden="true"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="" class="launch-lesson"><i
                                            class="fa fa-user"
                                            aria-hidden="true"></i> View Student</a>
                                </li>
                                <li>
                                    <a href=""><i
                                            class="fa fa-flag"
                                            aria-hidden="true"></i> Flag for Intervention</a>
                                </li>
                                <li><a id="cbutton" href="#"><input hidden
                                                                    class="lesson_id"
                                                                    value="1"><i
                                            class="fa fa-minus-circle"
                                            aria-hidden="true"></i> Invite to lesson</a>
                                </li>
                                <li><a id="cbutton" href="#"><input hidden
                                                                    class="lesson_id"
                                                                    value="1"><i
                                            class="fa fa-minus-circle"
                                            aria-hidden="true"></i> Email</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>';
      }

      return $str;
    }
}
