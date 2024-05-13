<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Note extends Model
{
    protected $fillable = [
        'notes', 'lesson_id'
    ];

    public $timestamps = false;

}
