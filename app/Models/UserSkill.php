<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //


    protected $table = 'user_skills';


	public function SkillLevel() {
		return $this->belongsTo('\App\Models\SkillLevel', 'level_id');
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
