<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syllable extends Model
{
    protected $fillable = [
        'user_id','pt_id','syllable','score'
    ];

}