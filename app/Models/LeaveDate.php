<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveDate extends Model
{

	protected $table = 'leave_dates';

    protected $fillable = [
    	'user_id',
    	'leave_id',
    	'leave_date',
    	'status'
    ];




}
