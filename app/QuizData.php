<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizData extends Model
{
	protected $table = 'quiz_data';

    protected $fillable = [
        'student_id', 'invite_id', 'quiz_name', 'quiz_attempts', 'total_questions', 'status', 'score'
    ];

    // public $casts = ['data' => 'array'];
}
