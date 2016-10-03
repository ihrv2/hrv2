<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    //

	protected $table = 'user_educations';


    protected $fillable = [
        'user_id',
        'year_from',
        'year_to',
        'name_education',
        'result'
    ];


    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


	public function education_create($data, $uid) {
		$this->user_id = $uid;
		$this->year_from = $data['year_from'];
		$this->year_to = $data['year_to'];
		$this->name_education = $data['name_education'];			
		$this->result = $data['result'];			
		$this->save();					
		$msg = array('Education successfully added.', 'success', 'mod.user.view');	
		return $msg;		
	}	




	public function education_update($data) {
		$this->year_from = $data['year_from'];
		$this->year_to = $data['year_to'];	
		$this->name_education = $data['name_education'];			
		$this->result = $data['result'];					
		$this->save();					
		$msg = array('Education successfully updated.', 'success', 'mod.user.view');	
		return $msg;		
	}	



	public function site_delete()
	{
		$this->delete();
		$msg = array('Site successfully deleted.', 'success', 'mod.site.index');	
		return $msg;		
	}



  


}
