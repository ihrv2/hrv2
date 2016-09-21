<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //

	protected $table = 'positions';


	public function GroupName() {
		return $this->belongsTo('\App\Models\Group', 'group_id');
	}	
	



	public function position_create($data) {
		$this->name = $data['name'];		
		$this->salary = $data['salary'];	
		$this->group_id = $data['group_id'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function position_update($data) {
		$this->name = $data['name'];		
		$this->salary = $data['salary'];	
		$this->group_id = $data['group_id'];				
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}
    
}
