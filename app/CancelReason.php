<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{
    protected $table = 'cancel_reasons';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
