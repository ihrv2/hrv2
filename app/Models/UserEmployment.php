<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmployment extends Model
{
    //

	protected $table = 'user_employments';

    protected $fillable = [
    	'user_id',
    	'date_from',
    	'date_to',
    	'company',
    	'position',
    	'salary'
    ];



    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }



	public function employment_create($data, $uid) {
		$this->user_id = $uid;
		$this->date_from = $data['from_year'].'-'.$data['from_month'].'-'.'01';
		$this->date_to = $data['to_year'].'-'.$data['to_month'].'-'.'01';
		$this->company = $data['company'];
		$this->position = $data['position'];			
		$this->salary = $data['salary'];			
		$this->save();					
		$msg = array('Employment successfully added.', 'success', 'mod.user.view');	
		return $msg;	
	}	



	public function employment_update($data) {
		$this->date_from = $data['from_year'].'-'.$data['from_month'].'-'.'01';
		$this->date_to = $data['to_year'].'-'.$data['to_month'].'-'.'01';
		$this->company = $data['company'];
		$this->position = $data['position'];			
		$this->salary = $data['salary'];						
		$this->save();					
		$msg = array('Employment successfully updated.', 'success', 'mod.user.view');	
		return $msg;	
	}	



	public function site_delete()
	{
		$this->delete();
		$msg = array('Site successfully deleted.', 'success', 'mod.site.index');	
		return $msg;		
	}



	    
}
