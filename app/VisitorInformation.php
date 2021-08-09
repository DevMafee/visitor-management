<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitorInformation extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\EmployeeInformation','employee_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
