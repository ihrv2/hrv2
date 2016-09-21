<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

	protected $table = 'regions';


	public $timestamps = false;



	public function RegionManager() {
		return $this->belongsTo('\App\Models\User', 'report_to', 'id');
	}


	public function RegionManagerJob() {
		return $this->belongsTo('\App\Models\UserJob', 'report_to', 'user_id')->where('status', 1);
	}

	public function ListState() {
		return $this->hasMany('\App\Models\State', 'region_id');
	}

	




	public function region_create($data) {
		$this->name = $data['name'];		
		$this->name_eng = $data['name_eng'];	
		$this->report_to = $data['report_to'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function region_update($data) {
		$this->name = $data['name'];		
		$this->name_eng = $data['name_eng'];	
		$this->report_to = $data['report_to'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}



}
