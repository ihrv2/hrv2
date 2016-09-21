<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mukim extends Model
{

	protected $table = 'mukims';


	public $timestamps = false;




	public function mukim_create($data) {
		$this->name = $data['name'];		
		$this->district_id = $data['district_id'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function mukim_update($data) {
		$this->name = $data['name'];		
		$this->district_id = $data['district_id'];				
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}

}
