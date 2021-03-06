<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepAttachment extends Model
{
    //

	protected $table = 'leave_rep_attachments';


    protected $fillable = [
    	'user_id',
    	'leave_rep_id',
    	'filename',
    	'ext',
    	'size'
    ];



	public function create_file($data) {
		$this->user_id = $data['user_id'];		
		$this->leave_rep_id = $data['leave_rep_id'];		
		$this->filename = $data['filename'];		
		$this->ext = $data['ext'];		
		$this->size = $data['size'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}			
	}    
}
