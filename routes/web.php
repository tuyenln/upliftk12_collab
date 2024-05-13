<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@homepage')->name('home');
Route::get('/features', 'HomeController@features')->name('features');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');
Route::get('/forgot', 'HomeController@forgetPage')->name('forgot');
Route::post('/forget_link', 'HomeController@sendLink')->name('forget_link');
Route::get('/password_reset/{token}/{email}', 'HomeController@passwordReset');
Route::post('/password_reset', 'HomeController@resetPassword');

Route::get('/fastLogin/{username}/{password}', 'Auth\LoginController@fastLogin');

Route::post('/update_activity_fix', 'HomeController@updateActivityFix')->name('updateActivityFix');


Route::get('/index-test', function () {
    return view('index-test');
});

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/getUserInfo', 'HomeController@getUserInfo');
Route::get('/getActiveLessonId', 'HomeController@getActiveLessonId');
Route::get('/generateteachers', 'HomeController@generateTeachers');
Route::get('/writeCSV', 'HomeController@writeCSV');
Route::post('/activity-help', 'HomeController@activityHelp');
Route::post('/add-activity', 'HomeController@addActivity');
Route::post('/update-activityhelp', 'HomeController@updateActivityHelp');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
// Route::POST('/add', 'PrincipalController@add');
Route::post('/userlogin', 'Auth\LoginController@checklogin');

Route::POST('/get_school_dist', 'HomeController@get_school_dist');
Route::POST('/get_school_district', 'AjaxController@get_school_dist');

Route::get('/free-trial', 'HomeController@freeTrial');
Route::post('/free-trial', 'HomeController@postFreeTrial');
Route::get('/teacher/activation/{token}', 'HomeController@teacherActivation')->name('activation');

Route::post('/newsletter', 'HomeController@newsletter');

Route::get('/term-of-use', 'HomeController@termOfUse');
Route::get('/privacy-policy', 'HomeController@privacyPolicy');

Route::group(['middleware' => ['web', 'DropboxAuthenticated']], function(){
    Route::get('dropbox', function(){
        return Dropbox::post('users/get_current_account');
    });
});

/*
Admin Routes
*/

Route::get('/admin', function () {
    if(Auth::user()){
        return Dropbox::connect();
    }
    return redirect('/login');
});

Route::group(
    [
        'prefix'     => 'admin',
        'middleware' => [
            'auth','check_user_role:1'
        ],
    ],
    function() {

        Route::get('/home', 'Admin\AdminController@index')->name('admin.home');
        // Route::get('/add/principal', 'Admin\AdminController@addprincipal')->name('admin.add.principal');
        Route::resource('principal', 'Admin\PrincipalController', ['names' => 'admin.principal']);
        Route::resource('teacher', 'Admin\TeacherController', ['names' => 'admin.teacher']);
        Route::resource('teacher-signup', 'Admin\TeacherSignupController', ['names' => 'admin.teacher.signup']);
        Route::resource('subject', 'Admin\SubjectController', ['names' => 'admin.subject']);
        Route::resource('resource_type', 'Admin\ResourceTypeController', ['names' => 'admin.resource_type']);
        Route::resource('gradelevel', 'Admin\GradeLevelController', ['names' => 'admin.gradelevel']);
        Route::resource('lesson', 'Admin\LessonController', ['names' => 'admin.lesson']);
        Route::post('getSchools', 'Admin\TeacherController@getSchools')->name('admin.teacher.getSchools');
        Route::get('addSchools', 'Admin\TeacherController@addSchools')->name('admin.teacher.addSchools');
        Route::post('addSchools', 'Admin\TeacherController@addSchoolPost')->name('admin.teacher.addSchools');
        Route::post('addDistrict', 'Admin\TeacherController@addDistrictPost')->name('admin.teacher.addDistrict');
        Route::get('note', 'Admin\NoteController@index')->name('admin.note.index');
        Route::get('note/{id}/edit', 'Admin\NoteController@edit')->name('admin.note.edit');
        Route::get('note/{id}/create', 'Admin\NoteController@create')->name('admin.note.create');
        Route::post('note/{id}/update', 'Admin\NoteController@update')->name('admin.note.update');
        Route::delete('note/{lesson_id}/lesson/{id}/destroy', 'Admin\NoteController@destroy')->name('admin.note.destroy');
        Route::get('/contact', 'Admin\AdminController@contact')->name('admin.contact');

        Route::get('/assessments', 'Admin\AdminController@assessments')->name('admin.assessment');
        Route::get('/assessments/add', 'Admin\AdminController@addAssessment')->name('admin.assessment.add');
        Route::get('/assessments/list', 'Admin\AdminController@listAssessment')->name('admin.assessment.ListPage');
        Route::post('/assessments/add', 'Admin\AdminController@storeAssessment')->name('admin.assessment.store');
        Route::get('/assessments/edit/{id}', 'Admin\AdminController@editAssessment')->name('admin.assessment.edit');
        Route::post('/assessments/edit/{id}', 'Admin\AdminController@updateAssessment')->name('admin.assessment.postedit');
        Route::post('/assessments/destroy/{id}', 'Admin\AdminController@destroyAssessment')->name('admin.assessment.destroy');

        Route::get('/library', 'Admin\AdminController@library')->name('admin.library');
        Route::get('/demo_requests', 'Admin\AdminController@demo_requests')->name('admin.demo_requests');
        Route::get('/lesson_log', 'Admin\AdminController@lesson_log')->name('admin.lesson_log');

        Route::get('/manage-shortcode', 'Admin\AdminController@manageShortcode')->name('admin.shortcode');
        Route::post('/update-shortcode', 'Admin\AdminController@updateShortcode')->name('admin.update_shortcode');

    }
);

/*
Principal Routes
*/

Route::group(
    [
        'prefix'     => 'principal',
        'middleware' => [
            'auth','check_user_role:2'
        ],
    ],
    function() {
        Route::get('/', 'HomeController@principal')->name('principal');
        Route::get('/home', 'HomeController@principal')->name('principal.home');
        Route::get('/change_password', 'HomeController@principalChangePassword')->name('principal.ChangePassword');
        Route::post('/update_password', 'HomeController@principalUpdatePassword')->name('principal.updatePassword');
        Route::get('/teacher', 'Admin\TeacherController@index')->name('principal.teacher.index');
        Route::get('/teacher/create', 'Admin\TeacherController@create')->name('principal.teacher.create');
        Route::post('/teacher/store', 'Admin\TeacherController@store')->name('principal.teacher.store');
        Route::get('/teacher/{id}/edit', 'Admin\TeacherController@edit')->name('principal.teacher.edit');
        Route::put('/teacher/{id}/edit', 'Admin\TeacherController@update')->name('principal.teacher.update');
        Route::delete('/teacher/{id}/destroy', 'Admin\TeacherController@destroy')->name('principal.teacher.destroy');
        // Route::resource('teacher', 'Admin\TeacherController', ['names' => 'principal.teacher']);
        // Route::get('/home', 'Principal\PrincipalController@index')->name('principal.home');
        Route::get('/student/uploadcsv', 'Principal\StudentController@uploadcsv')->name('principal.student.uploadcsv');
        Route::POST('/student/uploadcsv', 'Principal\StudentController@uploadcsv')->name('principal.student.postcsv');
        Route::resource('student', 'Principal\StudentController', ['names' => 'principal.student']);

    }
);


/*
Teacher Routes
*/

Route::get('/teacher/signup', 'Auth\RegisterController@teachersignup')->name('teacher.signup');
Route::POST('/teacher/postsignup', 'Auth\RegisterController@teachersignuppost')->name('teacher.postsignup');
Route::group(
    [
        'prefix'     => 'teacher',
        'middleware' => [
            'auth','check_user_role:3'
        ],
    ],
    function() {
        Route::get('/update-payment-method', 'HomeController@update_payment_method')->name('teacher.update_payment_method');
        Route::get('/subscribed', 'HomeController@subscribed');
        Route::get('/unsubscribe', 'HomeController@cancel_membership')->name('teacher.cancel_membership');
        Route::post('/unsubscribe', 'HomeController@postCancel_membership')->name('teacher.postCancel_membership');
        Route::post('/order-post', ['as'=>'order-post','uses'=>'HomeController@orderPost']);
        Route::post('note/{id}/store', 'Admin\NoteController@store')->name('admin.note.store');
        Route::post('note/{id}/ajaxStore', 'Admin\NoteController@ajaxStore')->name('admin.note.ajaxStore');
        Route::get('/', 'HomeController@teacher')->name('teacher');
      Route::post('/getAjaxLessons', 'HomeController@getAjaxLessons')->name('teacher.getAjaxLessons');
      Route::get('/selectClass/{id}', 'HomeController@selectClass')->name('teacher.selectClass');

        Route::get('/home', 'HomeController@teacher')->name('teacher.home');

        // Route::get('/home', function () { return view('teacher/home'); })->name('teacher.home');

        Route::get('/student-enroll', 'Teacher\ClassController@enroll')->name('teacher.enroll');


        Route::get('/manage/student/{id}', 'Teacher\ClassController@managestudent')->name('teacher.class.manage.student');


        Route::get('/delete/student/{id}/{sid}', 'Teacher\ClassController@deletestudent')->name('teacher.class.delete.student');
        Route::post('/manage/student/{id}', 'Teacher\ClassController@managestudent')->name('teacher.class.manage.poststudent');
        Route::get('/print/{type}/{id}', 'Teacher\ClassController@printroster')->name('teacher.class.printroster');
        Route::resource('class', 'Teacher\ClassController', ['names' => 'teacher.class']);

        Route::get('/class/{id}/info', 'Teacher\ClassController@info')->name('teacher.class.info');

        Route::get('/class-report', 'Teacher\ClassController@report')->name('teacher.class.report');

        Route::post('/get-assessments', 'Teacher\ClassController@getAssessments')->name('teacher.class.getAssessments');
        Route::post('/get-students', 'Teacher\ClassController@getStudents')->name('teacher.class.getStudents');

        Route::post('/get-passages', 'Teacher\ClassController@getPassages')->name('teacher.class.getPassages');

        Route::get('/placement-detail/{id}', 'Teacher\ClassController@placementDetail')->name('teacher.placement.singlee');
        Route::post('/update-score', 'Teacher\ClassController@updateScore')->name('teacher.updatescore');

        Route::get('/lesson', 'Teacher\ClassController@lesson')->name('teacher.lesson');
        Route::get('/lesson/{id}', 'Teacher\ClassController@lessonDetail')->name('teacher.lesson.detail');
        Route::get('/lesson/start/{id}/{mod}', 'Teacher\ClassController@lessonStart')->name('teacher.lesson.start');
        Route::get('/student-activity/help/{id}/{mod}', 'Teacher\ClassController@activtyHelpStart')->name('teacher.student-activity');
        Route::post('/updateProfile', 'HomeController@updateProfile')->name('teacher.updateProfile');
        Route::get('/changepassword', 'HomeController@changePassword')->name('teacher.changePassword');
        Route::post('/updatePassword', 'HomeController@updatePassword')->name('teacher.updatePassword');
        //Route::post('/lesson/invite', 'Teacher\ClassController@inviteStudents')->name('teacher.inviteStudents');

        Route::get('/invite', 'Teacher\ClassController@invite')->name('teacher.invite');
        Route::delete('/destory/invite/{invite_id}/student/{student_id}', 'Teacher\ClassController@destoryInvite')->name('teacher.invite.destroy');
        Route::delete('/destory/invite/{invite_id}', 'Teacher\ClassController@destoryInviteLesson')->name('teacher.invite.lesson.destroy');

        Route::get('/nodejs', 'HomeController@teachernodejs')->name('teacher.nodejs');
        Route::get('/profile', 'HomeController@profile')->name('teacher.profile');

        Route::get('/math-report', 'Teacher\ClassController@mathreport')->name('teacher.mathreport');
        Route::post('/filter_students', 'Teacher\ClassController@filter_students')->name('teacher.filter_students');
        Route::get('/get_list_questions', 'Teacher\ClassController@get_list_questions')->name('teacher.get_list_questions');

        Route::get('/inviteStuents/tolesson/{invite_id}/{is_add}', [
          'uses'  =>  'Teacher\ClassController@inviteStudents',
          'as'    =>  'teacher.inviteStudent'
        ]);

        Route::post('/inviteStuents/tolesson/{invite_id}/{is_add}', [
          'uses'  =>  'Teacher\ClassController@postInviteStudents',
          'as'    =>  'teacher.postInviteStudent'
        ]);

        Route::post('/clear-invite', [
            'uses'  =>  'Teacher\ClassController@postClearInvites',
            'as'    =>  'teacher.postClearInvites'
        ]);

        Route::post('/hide-invite', [
            'uses'  =>  'Teacher\ClassController@postHideInvite',
            'as'    =>  'teacher.postHideInvite'
        ]);

        Route::post('/show-invite', [
            'uses'  =>  'Teacher\ClassController@postShowInvite',
            'as'    =>  'teacher.postShowInvite'
        ]);

        Route::post('/remove-invite', [
          'uses'  =>  'Teacher\ClassController@postRemoveInvite',
          'as'    =>  'teacher.postRemoveInvite'
        ]);

        Route::get('/manageClass', [
            'uses'  =>  'Teacher\ClassController@manageClass',
            'as'    =>  'teacher.manageClass'
        ]);

        Route::get('/manageStudent/{id}', [
            'uses'  =>  'Teacher\ClassController@manageStudent',
            'as'    =>  'teacher.manageStudent'
        ]);

        Route::get('/addClass', [
            'uses'  =>  'Teacher\ClassController@addClass',
            'as'    =>  'teacher.addClass'
        ]);

	 Route::get('/calendar/read', 'Teacher\ClassController@readCalendar');

        Route::get('/addStudent', [
          'uses'  =>  'Teacher\ClassController@addStudent',
          'as'    =>  'teacher.addStudent'
        ]);

        Route::post('/addStudent', [
          'uses'  =>  'Teacher\ClassController@postAddStudent',
          'as'    =>  'teacher.postAddStudent'
        ]);

        Route::post('/getQuizData', [
            'uses'  =>  'Teacher\ClassController@getQuizData',
            'as'    =>  'teacher.getQuizData'
        ]);
        Route::get('/student/uploadcsv', 'Teacher\StudentController@uploadcsv')->name('teacher.student.uploadcsv');
        Route::POST('/student/uploadcsv', 'Teacher\StudentController@uploadcsv')->name('teacher.student.postcsv');
        Route::resource('student', 'Teacher\StudentController', ['names' => 'teacher.student']);
    }
);


Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@submitContact')->name('postcontact');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/howto', 'HomeController@howto')->name('howto');
Route::get('/solutions', 'HomeController@solutions')->name('solutions');

Route::get('/captivate', 'HomeController@captivate')->name('captivate');

Route::post('/getSurveyData', 'HomeController@getSurveyData')->name('getSurveyData');
Route::post('/getQuizData', 'HomeController@getQuizData')->name('getQuizData');
Route::post('profileinsert', 'HomeController@ajaxRequestPostProfile')->name('profileinsert');



Route::get('/migrate', function() {
    // $exitCode = Artisan::call('migrate');
    return $exitCode;
});

/*
    Student Routes
*/

Route::group(
    [
        'prefix'     => 'student',
        /*'middleware' => [
            'auth','check_user_role:4'
        ],*/
    ],
    function() {

        Route::get('/', 'HomeController@student')->name('student');
        Route::get('/home', 'HomeController@student')->name('student.home');
        Route::get('/reading', 'HomeController@reading')->name('student.reading');
        Route::get('/nodejs', 'HomeController@studentnodejs')->name('student.nodejs');
        Route::get('/lesson/start/{id}/{mod}', 'HomeController@lessonStart')->name('student.lesson.start');
        Route::get('/lesson/premiumstart/{id}/{mod}', 'HomeController@premiumStart')->name('student.lesson.premiumstart');
        Route::get('/lesson/premiumstartquiz/{id}/{mod}/{invite_id}', 'HomeController@premiumStartQuiz')->name('student.lesson.premiumstartquiz');

        Route::get('/lessons', 'HomeController@lessons')->name('student.lessons');
        Route::get('/lesson/{id}', 'HomeController@lessonSingle')->name('student.lesson.single');
        Route::post('/lesson/starlesson', 'HomeController@starttriallesson')->name('student.starttriallesson');
        Route::post('/get-vote', 'HomeController@getVote');

    }
);

/*
    Assessment
*/

Route::group(
    [
        'prefix'     => 'assessment',
        'middleware' => [
            'auth','check_user_role:4'
        ],
    ],
    function() {
        Route::get('/{id}', 'AssessmentController@index')->name('assessment.index');
        Route::get('/{id}/sections', 'AssessmentController@sections')->name('assessment.sections');
        Route::get('/{id}/sections/{step}/new', 'AssessmentController@sectionsStepNew')->name('assessment.sections.step.new');
        Route::get('/{id}/sections/{step}', 'AssessmentController@sectionsStep')->name('assessment.sections.step');
        Route::post('/{id}/sections/{step}', 'AssessmentController@sectionsStepNext')->name('assessment.sections.stepnext');
        Route::post('/{id}/speechace', 'AssessmentController@ajaxSpeech')->name('assessment.sections.ajaxspeech');

        Route::get('/{id}/passages/{step}', 'AssessmentController@passageStep')->name('assessment.passage.step');
        Route::get('/{id}/passage-success', 'AssessmentController@passageSuccess')->name('assessment.passage.success');

    }
);

app('debugbar')->disable();
