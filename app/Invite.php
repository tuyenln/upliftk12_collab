<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Lesson;

class Invite extends Model
{
	protected $table = 'invites';

    protected $fillable = [
        'lesson_id','students', 'class_id'
    ];

    public $casts = ['students' => 'array'];

    public function students()
    {
        return User::whereIn('id', $this->students)->get();
    }

    public function lesson()
    {
        return Lesson::findorfail($this->lesson_id);
    }

    static function deleteStudent($inviteId,$sId)
    {
        $aRow = Invite::find($inviteId);
        $list = $aRow->students;
        $list = array_diff( $list, array($sId));
        $aRow->students = $list;
        $aRow->save();
        return true;
    }
    static function getLessons($student_id)
    {
        $aRow = Invite::all();
        $retVal = array();
        foreach($aRow as $row) {
            if (in_array($student_id, $row->students)) {
                array_push($retVal, $row->lesson_id);
            }
        }
        return $retVal;
    }

}
