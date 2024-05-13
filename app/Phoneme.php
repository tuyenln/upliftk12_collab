<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phoneme extends Model
{
    protected $fillable = [
        'user_id','pt_id','phoneme','score'
    ];

}