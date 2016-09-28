<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{

	protected $table = 'leave_types';


    protected $fillable = [
    	'name',
    	'code',
    	'total'
    ];


	public function leave_type_create($data) {
		$this->name = $data['name'];		
		$this->code = $data['code'];		
		$this->total = $data['total'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	




	public function leave_type_update($data) {
		$this->name = $data['name'];		
		$this->code = $data['code'];		
		$this->total = $data['total'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}


}
