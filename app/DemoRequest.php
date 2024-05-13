<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemoRequest extends Model
{
    protected $fillable = [
        'name', 'email'
    ];

    protected $table='demo_requests';
}
