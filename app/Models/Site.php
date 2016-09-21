<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

	protected $table = 'sites';

	public $timestamps = false;





	public function PhaseName() {
		return $this->belongsTo('\App\Models\Phase', 'phase_id');
	}

	public function DistrictName() {
		return $this->belongsTo('\App\Models\District', 'district_id');
	}

	public function StateName() {
		return $this->belongsTo('\App\Models\State', 'state_id');
	}

	public function RegionName() {
		return $this->belongsTo('\App\Models\Region', 'region_id');
	}		

	public function MukimName() {
		return $this->belongsTo('\App\Models\Mukim', 'mukim_id');
	}		


	public function site_create($data) {
		$this->id = $data['id'];			
		$this->name = $data['name'];
		$this->phase_id = $data['phase_id'];
		$this->mukim_id = $data['mukim_id'];
		$this->district_id = $data['district_id'];
		$this->state_id = $data['state_id'];		
		$this->region_id = $data['region_id'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	





	public function site_update($data) {
		$this->name = $data['name'];
		$this->phase_id = $data['phase_id'];
		$this->mukim_id = $data['mukim_id'];
		$this->district_id = $data['district_id'];
		$this->state_id = $data['state_id'];		
		$this->region_id = $data['region_id'];			
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}


}
