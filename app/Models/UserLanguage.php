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



