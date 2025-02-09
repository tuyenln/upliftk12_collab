<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role\UserRole;

class District extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

}