<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

	protected $table = 'sites';

	// public $timestamps = false;


    protected $fillable = [
    	'code',
    	'address',
    	'region_id',
    	'email',
    	'state_id',
    	'phase_id',
    	'mukim_id',
    	'district_id'
    ];


	public function PhaseName() {
		return $this->belongsTo('IhrV2\Models\Phase', 'phase_id');
	}

	public function DistrictName() {
		return $this->belongsTo('IhrV2\Models\District', 'district_id');
	}

	public function StateName() {
		return $this->belongsTo('IhrV2\Models\State', 'state_id');
	}

	public function RegionName() {
		return $this->belongsTo('IhrV2\Models\Region', 'region_id');
	}		

	public function MukimName() {
		return $this->belongsTo('IhrV2\Models\Mukim', 'mukim_id');
	}		


	public function site_create($data) {
		
	}	





	public function site_update($data) {

	}


}
