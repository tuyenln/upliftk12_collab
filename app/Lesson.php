<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Note;

class Lesson extends Model
{

    protected $fillable = [
        'name', 'lessons_url', 'quiz_url', 'image_url', 'grade_levels', 'subject_id', 'resource_type_id', 'objective', 'description', 'cptx_url', 'quiz_cptx_url'
    ];

    public $casts = ['grade_levels' => 'array', 'student_lists' => 'array', 'note_list' => 'array'];

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }
    public function resource_type() {
        return $this->belongsTo('App\ResourceType');
    }
    public function gl() {
		if($this->grade_levels)
			return GradeLevel::whereIn('id', $this->grade_levels)->pluck('name')->implode(', ');
    }

    public function getImageAttribute(){
        if($this->image_url){
            return '<img src="'.asset("public".$this->image_url).'" />';
        }else {
            return '<img src="https://via.placeholder.com/400x300.png?text=UpliftK12" />';
        }
    }
    public function students($invite_id)
    {
        $invite = Invite::where('id', $invite_id)->get();
        $students = [];
        if(count($invite) >0)
            $students = $invite[0]->students;
        return User::whereIn('id', $students)->get();
    }

    public function getStudentArray($invite_id)
    {
        $invite = Invite::where('lesson_id', $invite_id)->orderBy('id', 'desc')->get();
        $students = [];
        if(count($invite) >0)
            $students = $invite[0]->students;
        return $students;
    }
    public function isHidden($invite_id)
    {
        $invite = Invite::where('id', $invite_id)->get();
        return $invite[0]->isHidden;
    }
    public function getDate($teacher_id)
    {
        $invite = Invite::where('lesson_id', $teacher_id)->orderBy('id', 'desc')->get();
        $date = Carbon::now();
        if(count($invite) >0) {
            $date = $invite[0]->start_date;
        } else {
            $date = date("Y-m-d");
        }
        return $date;
    }
    public function notes()
    {
        return Note::whereIn('id', $this->note_list?$this->note_list:[])->get();
    }
    static function getLessons($student_id)
    {
        $aRow = Invite::all();
        $retVal = array();
        foreach($aRow as $row) {
            if (!empty($row->students)) {
                if (in_array($student_id, $row->students)) {
                    array_push($retVal, ['lesson_id' => $row->lesson_id, 'invite_id' => $row->id, 'teacher_id' => $row->teacher_id]);
                }
            }
        }
        return $retVal;
    }

    static function getLessonswithClass($teacher_id, $class_id) {
        $aRow = Invite::where('teacher_id', $teacher_id)->where('class_id', $class_id)->get();
        $retVal = array();
        foreach ($aRow as $row) {
            array_push($retVal, ['lesson_id' => $row->lesson_id, 'invite_id' => $row->id, 'teacher_id' => $row->teacher_id]);
        }
        return $retVal;
    }
}
