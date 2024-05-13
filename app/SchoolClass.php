<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Assessment;
use App\User;

class SchoolClass extends Model
{
	protected $table = 'classes';

    protected $fillable = [
        'name','grade_level_id','subject_id','school_id','teacher_id','student_lists'
    ];

    public $casts = ['student_lists' => 'array'];


    static function deleteStudent($aClassId,$sId)
    {
    	/*$aClass = SchoolClass::where('id','=',$aClassId)->first();       
        $student_lists = $aClass->student_lists;
        $student_lists_array = $student_lists ? explode(",", $student_lists) : array();
        $student_lists_array = array_diff( $student_lists_array, array($sId));
        $aInsert['student_lists'] = @implode(",",$student_lists_array);
        $aRow = SchoolClass::find($aClassId);
        $aRow->update($aInsert);*/
        $aRow = SchoolClass::find($aClassId);
        $list = $aRow->student_lists;
        $list = array_diff( $list, array($sId));
        $aRow->student_lists = $list;
        $aRow->save();
        return true;
    }

    public function students()
    {
        if ($this->student_lists == NULL)
        return [];
        return User::whereIn('id', $this->student_lists)->get();
    }

    public function assessments(){
        return Assessment::where('subject', $this->subject_id)->get();
    }

    public function subject(){
        return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function grade_level(){
        return $this->belongsTo('App\GradeLevel', 'grade_level_id');
    }

    public function school_district(){
        return $this->belongsTo('App\SchoolDistrict', 'school_id');
    }

}
