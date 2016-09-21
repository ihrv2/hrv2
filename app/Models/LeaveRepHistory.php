<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepHistory extends Model
{
    //

	protected $table = 'leave_rep_histories';


	public function LeaveStatusName() {
		return $this->belongsTo('\App\Models\LeaveStatus', 'status');
	}

	public function LeaveActionByName() {
		return $this->belongsTo('\App\Models\User', 'user_id');
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
