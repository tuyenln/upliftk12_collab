<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\PlacementTest;

class SpeechResult extends Model {

	// protected $table = 'classes';

    protected $fillable = [
        'user_id','pt_id','word','result'
    ];

    public $casts = ['result' => 'array'];

    public function placement_test() {
    	return $this->belongsTo('App\PlacementTest', 'pt_id');
    }

    public function check($word) {
    	return "abc";
    }

    public function scopePlacementTest($query, $pt_id) {
        return $this->where('pt_id', $pt_id);
    }
    
}