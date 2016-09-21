<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveExtra extends Model
{
    //

	protected $table = 'leave_extras';




	public function UserDetail() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}

	public function LeaveTypeName() {
		return $this->belongsTo('\App\Models\LeaveType', 'leave_type_id');
	}





	public function leave_extra_create($data) {
		$this->user_id = $data['user_id']; // hidden user_id	
		$this->leave_id = $data['id']; // hidden id
		$this->date_reg = date('Y-m-d');
		$this->leave_type_id = $data['leave_type_id'];		
		$this->type_id = $data['type_id'];		
		$this->no_days = $data['no_days'];		
		$this->reason = $data['reason'];
		$this->status = 1;
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function leave_extra_update($data) {
		$this->leave_type_id = $data['leave_type_id'];		
		$this->type_id = $data['type_id'];		
		$this->no_days = $data['no_days'];		
		$this->reason = $data['reason'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}    
}
