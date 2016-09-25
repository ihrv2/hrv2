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


	public function skill_add($data) {
		$this->user_id = $data['uid'];			
		$this->name = $data['name'];			
		$this->level_id = $data['level'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	




	public function skill_edit($data) {
		$this->name = $data['name'];			
		$this->level_id = $data['level'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	



}
