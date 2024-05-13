<?php

namespace App\Moodle;

use Illuminate\Database\Eloquent\Model;


class CaseTbl extends Model
{
	protected $connection = 'moodle';

	protected $table = 'mdl_case_tbl';

	public $timestamps = false;

}