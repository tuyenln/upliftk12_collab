<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityHelp extends Model
{
    //
    protected $table = 'tbl_activityhelp';
    protected $primaryKey = 'ah_id';
    public $timestamps = false;
    protected $guarded = [];
}
