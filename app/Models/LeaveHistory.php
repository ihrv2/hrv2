<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveHistory extends Model
{
    //

	protected $table = 'leave_histories';



	public function LeaveStatusName() {
		return $this->belongsTo('\App\Models\LeaveStatus', 'status');
	}


	public function LeaveActionByName() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}





	// get only latest history
	public function LeaveRepLatestHistory() {
		return $this->hasOne('\App\Models\LeaveRepHistory', 'leave_rep_id')->where('flag', 1);
	}




	public function leave_process($data) {		
		// set current flag to 0
		$update = LeaveHistory::where('leave_id', $data['id'])->where('flag', 1)->update(array('flag' => 0));		
		// insert new leave_histories
		$this->user_id = Auth::user()->id;
		$this->leave_id = $data['id'];		
		$this->action_date = date('Y-m-d');	
		$this->action_remark = $data['remark'];
		$this->status = $data['type'];
		$this->flag = 1; // active 
		$this->save();
		return true;
	}
	


	public function leave_rm_process($data) {		
		// set current flag to 0
		$update = LeaveHistory::where('leave_id', $data['id'])->where('flag', 1)->update(array('flag' => 0));		
		// insert new leave_histories
		$this->user_id = Auth::user()->id;
		$this->leave_id = $data['id'];		
		$this->action_date = date('Y-m-d');	
		$this->action_remark = $data['remark'];
		$this->status = $data['type'];
		$this->flag = 1; // active 
		$this->save();
		return true;
	}
	    
}
