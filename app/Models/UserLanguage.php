<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    //


	protected $table = 'user_languages';



	public function WrittenLevel() {
		return $this->belongsTo('\App\Models\SkillLevel', 'written');
	}

	public function ReadingLevel() {
		return $this->belongsTo('\App\Models\SkillLevel', 'reading');
	}

	public function SpokenLevel() {
		return $this->belongsTo('\App\Models\SkillLevel', 'spoken');
	}	


	public function language_add($data) {
		$this->user_id = $data['uid'];			
		$this->dialect = $data['dialect'];			
		$this->desc = $data['desc'];			
		$this->written = $data['written'];			
		$this->reading = $data['reading'];			
		$this->spoken = $data['spoken'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	




	public function language_edit($data) {
		$this->dialect = $data['dialect'];			
		$this->desc = $data['desc'];			
		$this->written = $data['written'];			
		$this->reading = $data['reading'];			
		$this->spoken = $data['spoken'];					
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}	








}



