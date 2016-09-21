<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    //

	protected $table = 'user_educations';






	public function education_add($data) {
		$this->user_id = $data['uid'];			
		$this->year_from = $data['year_from'];
		$this->year_to = $data['year_to'];
		$this->name_education = $data['name_education'];			
		$this->result = $data['result'];			
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	




	public function education_edit($data) {
		$this->year_from = $data['year_from'];
		$this->year_to = $data['year_to'];	
		$this->name_education = $data['name_education'];			
		$this->result = $data['result'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	

    
}
