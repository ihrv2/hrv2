<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApprove extends Model
{
    //
	protected $table = 'leave_approves';



	public function LeaveInfo() {
		return $this->belongsTo('\App\Models\LeaveApplication', 'leave_id');
	}	

	
    
}
