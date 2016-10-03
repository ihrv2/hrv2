<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    //


	protected $table = 'user_languages';

    protected $fillable = [
    	'user_id',
    	'dialect',
    	'desc',
    	'written',
    	'reading',
    	'spoken'
    ];


    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


	public function WrittenLevel() {
		return $this->belongsTo('IhrV2\Models\SkillLevel', 'written');
	}

	public function ReadingLevel() {
		return $this->belongsTo('IhrV2\Models\SkillLevel', 'reading');
	}

	public function SpokenLevel() {
		return $this->belongsTo('IhrV2\Models\SkillLevel', 'spoken');
	}	


	public function language_create($data, $uid) {
		$this->user_id = $uid;
		$this->dialect = $data['dialect'];			
		$this->desc = $data['desc'];			
		$this->written = $data['written'];			
		$this->reading = $data['reading'];			
		$this->spoken = $data['spoken'];		
		$this->save();					
		$msg = array('Language successfully added.', 'success', 'mod.user.view');	
		return $msg;	
	}	




	public function language_update($data) {
		$this->dialect = $data['dialect'];			
		$this->desc = $data['desc'];			
		$this->written = $data['written'];			
		$this->reading = $data['reading'];			
		$this->spoken = $data['spoken'];					
		$this->save();					
		$msg = array('Language successfully updated.', 'success', 'mod.user.view');	
		return $msg;	
	}	



	public function family_delete($data) {
		$msg = array('Family successfully deleted.', 'success', 'mod.user.view');			
		return $msg;		
	}






}



