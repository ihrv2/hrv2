<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepHistory extends Model
{
    //

	protected $table = 'leave_rep_histories';


    protected $fillable = [
    	'user_id',
    	'leave_rep_id',
    	'action_date',
    	'action_remark',
    	'next_action_by',
    	'status',
    	'flag'
    ];



	public function LeaveStatusName() {
		return $this->belongsTo('IhrV2\Models\LeaveStatus', 'status');
	}

	public function LeaveActionByName() {
		return $this->belongsTo('IhrV2\Models\User', 'user_id');
	}



	public function leave_process($data) {		
		// set current flag to 0
		$update = LeaveRepHistory::where('leave_rep_id', $data['id'])->where('flag', 1)->update(array('flag' => 0));		
		// insert new leave_rep_histories
		$this->user_id = Auth::user()->id;
		$this->leave_rep_id = $data['id'];		
		$this->action_date = date('Y-m-d');	
		$this->action_remark = $data['remark'];
		$this->next_action_by = '';
		$this->status = 5; // Cancel
		$this->flag = 1; // active 
		$this->save();
		return true;
	}
	
    
}
