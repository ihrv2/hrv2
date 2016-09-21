<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    //

	protected $table = 'leave_balances';



	public function LeaveTypeName() {
		return $this->belongsTo('\App\Models\LeaveType', 'leave_type_id');
	}	
    
}
