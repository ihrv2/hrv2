<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepApprove extends Model
{
	protected $table = 'leave_rep_approves';



    protected $fillable = [
    	'user_id',
    	'leave_rep_id',
    	'total_day',
    	'flag'
    ];


}
