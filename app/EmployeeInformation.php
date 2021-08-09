<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeInformation extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    // protected $fillable = ['name', 'department', 'designation', 'contact'];
}
