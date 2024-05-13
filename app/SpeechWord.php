<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpeechWord extends Model
{
    protected $fillable = [
        'user_id','pt_id','word','score'
    ];

    public function scopeFilterWord($query, $word) {
        return $query->where('word', $word);
    }

}