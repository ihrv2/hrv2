<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmployment extends Model
{
    //

	protected $table = 'user_employments';




	public function employment_add($data) {
		$this->user_id = $data['uid'];				
		$this->date_from = $data['from_year'].'-'.$data['from_month'].'-'.'01';
		$this->date_to = $data['to_year'].'-'.$data['to_month'].'-'.'01';
		$this->company = $data['company'];
		$this->position = $data['position'];			
		$this->salary = $data['salary'];			
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	public function employment_edit($data) {
		$this->date_from = $data['from_year'].'-'.$data['from_month'].'-'.'01';
		$this->date_to = $data['to_year'].'-'.$data['to_month'].'-'.'01';
		$this->company = $data['company'];
		$this->position = $data['position'];			
		$this->salary = $data['salary'];						
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	    
}
