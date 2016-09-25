<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApprove extends Model
{
    //
	protected $table = 'leave_approves';


    protected $fillable = [
    	''
    ];



	public function LeaveInfo() {
		return $this->belongsTo('IhrV2\Models\LeaveApplication', 'leave_id');
	}	

	
    
}
