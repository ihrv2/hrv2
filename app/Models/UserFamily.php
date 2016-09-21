<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    //

	protected $table = 'user_families';



	public function family_add($data) {
		$this->user_id = $data['uid'];			
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	public function family_edit($data) {
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



    
}
