<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //


    protected $table = 'user_skills';


    protected $fillable = [
    	'user_id',
    	'name',
    	'level_id'
    ];


	public function SkillLevel() {
		return $this->belongsTo('IhrV2\Models\SkillLevel', 'level_id');
	}


    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }




	public function skill_create($data, $uid) {
		$this->user_id = $uid;
		$this->name = $data['name'];			
		$this->level_id = $data['level'];					
		$this->save();					
		$msg = array('Skill successfully added.', 'success', 'mod.user.view');	
		return $msg;	
	}	




	public function skill_update($data) {
		$this->name = $data['name'];			
		$this->level_id = $data['level'];					
		$this->save();					
		$msg = array('Skill successfully updated.', 'success', 'mod.user.view');	
		return $msg;		
	}	



	public function family_delete($data) {
		$msg = array('Family successfully deleted.', 'success', 'mod.user.view');			
		return $msg;		
	}





}
