<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacementTest extends Model
{
	// protected $table = 'classes';

    protected $fillable = [
        'user_id','assessment_id','section_id','passage_id','data'
    ];

    public $casts = ['data' => 'collection'];

    public function speech_results() {
        return $this->hasMany('App\SpeechResult', 'pt_id');
    }

    public function speech_words() {
        return $this->hasMany('App\SpeechWord', 'pt_id');
    }

    public function phonemes() {
        return $this->hasMany('App\Phoneme', 'pt_id');
    }

    public function syllables() {
        return $this->hasMany('App\Syllable', 'pt_id');
    }

    static function addNew($params)
    {
      $this->user_id = $params->user_id;
      $this->assessment_id = $params->assessment_id;
      $this->section_id = $params->section_id;
      $this->save();
    }  

    public function check($word) {
        return !! $this->speech_results()->where('word', $word)->first();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function assessment() {
        return $this->belongsTo('App\Assessment', 'assessment_id');
    }

    public function scopeFilterAssessment($query, $assessment_id) {
        return $query->where('assessment_id', $assessment_id);
    }

    public function scopeFilterPassage($query, $step) {
        return $query->where('passage_id', $step);
    }

    public function scopeFilterSection($query, $step) {
        return $query->where('section_id', $step);
    }
}
