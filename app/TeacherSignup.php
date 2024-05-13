<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSignup extends Model
{
    protected $table = 'teachers_signup';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
