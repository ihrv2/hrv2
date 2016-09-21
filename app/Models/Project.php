<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

	protected $table = 'projects';





	public function project_create($data) {
		$this->name = $data['name'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function project_update($data) {
		$this->name = $data['name'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}
}
