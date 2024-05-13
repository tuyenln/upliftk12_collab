<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyData extends Model
{
    //
    protected $table = 'survey_data';

    protected $fillable = [
        'student_id', 'question_name', 'lesson_id', 'sv_answer'
    ];

    // public $casts = ['data' => 'array'];

    
}
