<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmergency extends Model
{
    //

	protected $table = 'user_emergency_contacts';





	public function emergency_add($data) {
		$this->user_id = $data['uid'];			
		$this->name = $data['name'];			
		$this->telno = $data['telno'];			
		$this->address = $data['address'];			
		$this->relation = $data['relation'];			
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	public function emergency_edit($data) {
		$this->name = $data['name'];			
		$this->telno = $data['telno'];			
		$this->address = $data['address'];			
		$this->relation = $data['relation'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



    
}
