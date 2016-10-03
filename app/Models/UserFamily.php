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




	public function family_create($data, $uid) {
		$this->user_id = $uid;	
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];
		$this->save();							
		$msg = array('Family successfully added.', 'success', 'mod.user.view');	
		return $msg;		
	}	



	public function family_update($data) {
		$this->name = $data['name'];			
		$this->age = $data['age'];			
		$this->occupation = $data['occupation'];			
		$this->school_office = $data['school_office'];			
		$this->relation = $data['relation'];					
		$this->save();							
		$msg = array('Family successfully updated.', 'success', 'mod.user.view');	
		return $msg;		
	}	





	public function family_delete($data) {
		$msg = array('Family successfully deleted.', 'success', 'mod.user.view');			
		return $msg;		
	}



    
}
