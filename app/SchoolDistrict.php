<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role\UserRole;

class SchoolDistrict extends Model
{
	protected $table = 'school_district';

    public function district_info() {
        return $this->belongsTo('App\District', 'district');
    }

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

}