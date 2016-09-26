<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    //

	protected $table = 'leave_balances';


    protected $fillable = [
    	''
    ];



	public function LeaveTypeName() {
		return $this->belongsTo('IhrV2\Models\LeaveType', 'leave_type_id');
	}	
    




}
