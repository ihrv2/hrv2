<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCheckIn extends Model
{
    //


	protected $table = 'user_check_in';




	public function StateName() {
		return $this->belongsTo('\App\Models\State', 'state_id');
	}
	public function RegionName() {
		return $this->belongsTo('\App\Models\Region', 'region_id');
	}
	public function DistrictName() {
		return $this->belongsTo('\App\Models\District', 'district_id');
	}	


	public function checkin_add($data) {
		$this->user_id = $data['id'];			
		$this->reg_date = date('Y-m-d');
		$this->state_id = $data['state_id'];
		$this->region_id = $data['region_id'];
		$this->district_id = $data['district_id'];
		$this->sitecode = $data['site_id'];
		$this->status = 1;
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}	




	public function checkin_edit($data) {
		
	}	





	public function checkin_delete($id) {
		
	}		

	    
}
