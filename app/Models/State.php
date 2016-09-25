<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'states';


	public function RegionName() {
		return $this->belongsTo('IhrV2\Models\Region', 'region_id');
	}	
	
	

	public function ListDistrict() {
		return $this->hasMany('IhrV2\Models\District', 'state_id');
	}

}
