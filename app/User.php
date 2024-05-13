<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role\UserRole;
use App\MdlUserDetail;

use App\Libs\MoodleCurl;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','student_id','parent_user_id','user_type','username','mname','lname','school_district','district'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile_url(){
        switch ($this->user_type) {
            case 1:
                return route('admin.home');
                break;
            case 2:
                return route('principal');
                break;
            case 3:
                return route('teacher');
                break;

            default:
                return route('student');
                break;
        }
    }

    public function teacher_signup(){
        return $this->hasOne('App\TeacherSignup');
    }

    public function school_info() {
        return $this->belongsTo('App\SchoolDistrict', 'school_district');
    }

    public function classes() {
        return $this->hasMany('App\SchoolClass', 'teacher_id');
    }

    public function placement_tests() {
        return $this->hasMany('App\PlacementTest');
    }

    public function speech_results() {
        return $this->hasMany('App\SpeechResult');
    }

    public function speech_words() {
        return $this->hasMany('App\SpeechWord');
    }

    public function phonemes() {
        return $this->hasMany('App\Phoneme');
    }

    public function syllables() {
        return $this->hasMany('App\Syllable');
    }

    public function getFirstNameAttribute() {
        $name = explode(' ', $this->name);
        return $name[0] ?? '';
    }

    public function getLastNameAttribute() {
        $name = explode(' ', $this->name);
        return $name[1] ?? '';
    }

    public function getFullNameAttribute() {
        return $this->name.' '.$this->mname.' '.$this->lname;
    }
    public function getIsAdminAttribute() {
        return $this->user_type == UserRole::ADMIN;
    }
    public function urlCreateTeacher() {
        if ($this->is_admin) {
            return route('admin.teacher.create');
        }
        return route('principal.teacher.create');
    }
    public function urlEditTeacher($id) {
        if ($this->is_admin) {
            return route('admin.teacher.edit', $id);
        }
        return route('principal.teacher.edit', $id);
    }
    public function urlDeleteTeacher($id) {
        if ($this->is_admin) {
            return route('admin.teacher.destroy', $id);
        }
        return route('principal.teacher.destroy', $id);
    }

    //scope
    public function scopePrincipal($query) {
        return $query->where('user_type', '=', UserRole::PRINCIPAL);
    }
    public function scopeTeacher($query) {
        return $query->where('user_type', '=', UserRole::TEACHER);
    }
    public function scopeStudent($query) {
        return $query->where('user_type', '=', UserRole::STUDENT);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){

        });

        self::created(function($model){
            $curl = new MoodleCurl();
            $restformat = 'json';
            $domainname = 'https://upliftk12.com/assessments';
            $tokenUserCreate = 'e326f6ab8011bc62e04176a1a9b7c0ff';
            $functionnameUserCreate = 'core_user_create_users';
            $userDetails = new \stdClass();
            $ppas   =    'studentUP@12';

            $userDetails->username              =       $model->username;
            $userDetails->password              =       $ppas;
            $userDetails->firstname             =       $model->name;
            $userDetails->lastname              =       $model->mname.''.$model->lname;
            $userDetails->email                 =       $model->email;
            $userDetails->auth                  =       'manual';
            $userDetails->idnumber              =       $model->student_id;
            $users = array($userDetails);
            $params = array('users' => $users);
            /* create Account In Moodle*/
            $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $tokenUserCreate . '&wsfunction='.$functionnameUserCreate;
            $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
            $resp = $curl->post($serverurl . $restformat, $params);
            $respons        = json_decode($resp,true);
            if($respons && isset($respons[0])){
                $mdl_userID         =    $respons[0]['id'];
                $username       =    $respons[0]['username'];
                MdlUserDetail::create([
                    'username' => $model->username,
                    'mdl_UserID' => $mdl_userID,
                    'student_id' => $model->student_id,
                    'password' => base64_encode($ppas)
                ]);
                $model->mdl_UserID = $mdl_userID;
                $model->save();
            }
        });

        self::updating(function($model){
            // ... code here
        });

        self::updated(function($model){
            // ... code here
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }

    public function xulyUser(){
        $users = static::where('mdl_UserID', '=', 0)->where('user_type','=',UserRole::STUDENT)->get();
        dd($users);
        foreach($users as $model){
            $curl = new MoodleCurl();
            $restformat = 'json';
            $domainname = 'https://upliftk12.com/assessments';
            $tokenUserCreate = 'e326f6ab8011bc62e04176a1a9b7c0ff';
            $functionnameUserCreate = 'core_user_create_users';
            $userDetails = new \stdClass();
            $ppas   =    'studentUP@12';

            $userDetails->username              =       $model->username;
            $userDetails->password              =       $ppas;
            $userDetails->firstname             =       $model->name;
            $userDetails->lastname              =       $model->mname.''.$model->lname;
            $userDetails->email                 =       $model->email;
            $userDetails->auth                  =       'manual';
            $userDetails->idnumber              =       $model->student_id;
            $users = array($userDetails);
            $params = array('users' => $users);
            dump($params);
            /* create Account In Moodle*/
            $serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $tokenUserCreate . '&wsfunction='.$functionnameUserCreate;
            $restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';
            $resp = $curl->post($serverurl . $restformat, $params);
            $respons        = json_decode($resp,true);
            // dd($respons);
            if($respons && isset($respons[0])){
                $mdl_userID         =    $respons[0]['id'];
                $username       =    $respons[0]['username'];
                MdlUserDetail::create([
                    'username' => $model->username,
                    'mdl_UserID' => $mdl_userID,
                    'student_id' => $model->student_id,
                    'password' => base64_encode($ppas)
                ]);
                $model->mdl_UserID = $mdl_userID;
                $model->save();
            }
            dump($respons,$model->id);
        }
    }

}
