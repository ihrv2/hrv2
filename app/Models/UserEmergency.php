<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmergency extends Model
{
    //

	protected $table = 'user_emergency_contacts';



    protected $fillable = [
        'user_id',
        'name',
        'relation',
        'address',
        'telno'
    ];

    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }




	public function emergency_create($data, $uid) {
		$this->user_id = $uid;			
		$this->name = $data['name'];			
		$this->telno = $data['telno'];			
		$this->address = $data['address'];			
		$this->relation = $data['relation'];			
		$this->save();					
		$msg = array('Emergency Contact successfully added.', 'success', 'mod.user.view');	
		return $msg;	
	}	



	public function emergency_update($data) {
		$this->name = $data['name'];			
		$this->telno = $data['telno'];			
		$this->address = $data['address'];			
		$this->relation = $data['relation'];					
		$this->save();					
		$msg = array('Emergency Contact successfully updated.', 'success', 'mod.user.view');	
		return $msg;	
	}	



	public function site_delete()
	{
		$this->delete();
		$msg = array('Site successfully deleted.', 'success', 'mod.site.index');	
		return $msg;		
	}




    
}
