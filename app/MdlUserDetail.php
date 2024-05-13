<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role\UserRole;

class MdlUserDetail extends Authenticatable
{

	protected $table = 'mdl_UserDetails';

    protected $fillable = [
        'username', 'mdl_UserID', 'student_id', 'password'
    ];

    public $timestamps = false;
}