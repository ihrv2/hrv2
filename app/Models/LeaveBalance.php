<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    //

	protected $table = 'leave_balances';


    protected $fillable = [
    	'user_id',
    	'leave_type_id',
    	'balance',
    	'contract_id',
    	'year'
    ];



	public function LeaveTypeName() {
		return $this->belongsTo('IhrV2\Models\LeaveType', 'leave_type_id');
	}	
    




}
