<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

use App\GradeLevel;
use App\PlacementTest;

class Assessment extends Model
{
    protected $fillable = [
        'name', 'subject', 'grade_level', 'sections', 'passages'
    ];

    public $casts = ['grade_level' => 'array', 'sections'  => 'array', 'passages'  => 'array'];

    public function sub() {
    	return $this->belongsTo('App\Subject', 'subject');
    }

    public function placement_tests() {
        return $this->hasMany('App\PlacementTest');
    }

    public function phonemes() {
        return $this->hasManyThrough('App\Phoneme', 'App\PlacementTest', 'assessment_id', 'pt_id');
    }

    public function gl() {
		if($this->grade_level)
			return GradeLevel::whereIn('id', $this->grade_level)->pluck('name')->implode(', ');
    }

    public function doingQuiz($id) {
        return $this->placement_tests()->where(['section_id' => $id, 'user_id' => Auth::id()])->first();
    }

    public function donePassage($id) {
        return $this->placement_tests()->where(['passage_id' => $id, 'user_id' => Auth::id()])->first();
    }

    public function finishedQuiz($id) {
        $pl = $this->placement_tests()->where(['section_id' => $id, 'user_id' => Auth::id()])->first();
        if($pl) {
            $words = $this->sections[$id-1]['words'] ?? "";
            $count = count(explode(',', $words)) ?? 0;
            return $pl->speech_results->count() === $count;
        }
        return false;
    }

}
