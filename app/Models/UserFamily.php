<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    //

	protected $table = 'user_families';

    protected $fillable = [
    	'user_id',
    	'name',
    	'age',
    	'occupation',
    	'school_office',
    	'relation'
    ];

    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


	public function family_create($data) {
		$this->user_id = $data['uid'];			
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



	public function family_update($data) {
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



    
}
