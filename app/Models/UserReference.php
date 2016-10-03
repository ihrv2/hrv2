<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserReference extends Model
{
    //

	protected $table = 'user_references';

    protected $fillable = [
    	'user_id',
    	'name',
    	'relation',
    	'address',
    	'telno',
    	'occupation',
    	'period_known'
    ];


    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


	public function reference_create($data, $uid) {
		$this->user_id = $uid;		
		$this->name = $data['name'];			
		$this->relation = $data['relation'];			
		$this->address = $data['address'];			
		$this->telno = $data['telno'];			
		$this->occupation = $data['occupation'];			
		$this->period_known = $data['period_known'];
		$this->save();					
		$msg = array('Reference successfully added.', 'success', 'mod.user.view');	
		return $msg;		
	}	



	public function reference_update($data) {
		$this->name = $data['name'];			
		$this->relation = $data['relation'];			
		$this->address = $data['address'];			
		$this->telno = $data['telno'];			
		$this->occupation = $data['occupation'];			
		$this->period_known = $data['period_known'];				
		$this->save();					
		$msg = array('Reference successfully updated.', 'success', 'mod.user.view');	
		return $msg;	
	}	




	public function family_delete($data) {
		$msg = array('Family successfully deleted.', 'success', 'mod.user.view');			
		return $msg;		
	}




    
}
