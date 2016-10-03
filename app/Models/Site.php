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
		$this->code = $data['code'];		
		$this->address = $data['address'];		
		$this->email = $data['email'];	
		$this->region_id = $data['region_id'];	
		$this->state_id = $data['state_id'];	
		$this->phase_id = $data['phase_id'];	
		$this->mukim_id = $data['mukim_id'];	
		$this->district_id = $data['district_id'];	
		$this->save();					
		$msg = array('Site successfully added.', 'success', 'mod.site.index');	
		return $msg;		
	}	





	public function site_update($data) {
		$this->code = $data['code'];		
		$this->address = $data['address'];		
		$this->email = $data['email'];	
		$this->region_id = $data['region_id'];	
		$this->state_id = $data['state_id'];	
		$this->phase_id = $data['phase_id'];	
		$this->mukim_id = $data['mukim_id'];	
		$this->district_id = $data['district_id'];	
		$this->save();					
		$msg = array('Site successfully updated.', 'success', 'mod.site.index');	
		return $msg;
	}


	public function site_delete()
	{
		$this->delete();
		$msg = array('Site successfully deleted.', 'success', 'mod.site.index');	
		return $msg;		
	}


}
