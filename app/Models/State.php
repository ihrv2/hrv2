<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'states';


	public function RegionName() {
		return $this->belongsTo('\App\Models\Region', 'region_id');
	}	
	
	

	public function ListDistrict() {
		return $this->hasMany('\App\Models\District', 'state_id');
	}

}
