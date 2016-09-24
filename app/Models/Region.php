<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

	protected $table = 'regions';


	public $timestamps = false;



	protected $fillable = [
		'name',
		'name_eng',
		'report_to'
	];


	public function RegionManager() {
		return $this->belongsTo('\App\User', 'report_to', 'id');
	}


	public function RegionManagerJob() {
		return $this->belongsTo('\App\Models\UserJob', 'report_to', 'user_id')->where('status', 1);
	}

	public function ListState() {
		return $this->hasMany('\App\Models\State', 'region_id');
	}




	public function region_update($data) {
        $this->name = $data['name'];
        $this->name_eng = $data['name_eng'];
        $this->report_to = $data['report_to'];
        if ($this->save()) {
			$msg = array('Region successfully updated.', 'success');
        }
        else {
        	$msg = array('Update is fail', 'danger');
        }
        return $msg;
	}






}
