<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    //

	protected $table = 'phases';

	public $timestamps = false;





	public function phase_create($data) {
		$this->name = $data['name'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function phase_update($data) {
		$this->name = $data['name'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}
    
}
