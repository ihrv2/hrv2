<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReference extends Model
{
    //

	protected $table = 'user_references';



	public function reference_add($data) {
		$this->user_id = $data['uid'];			
		$this->name = $data['name'];			
		$this->relation = $data['relation'];			
		$this->address = $data['address'];			
		$this->telno = $data['telno'];			
		$this->occupation = $data['occupation'];			
		$this->period_known = $data['period_known'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	public function reference_edit($data) {
		$this->name = $data['name'];			
		$this->relation = $data['relation'];			
		$this->address = $data['address'];			
		$this->telno = $data['telno'];			
		$this->occupation = $data['occupation'];			
		$this->period_known = $data['period_known'];				
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	
    
}
