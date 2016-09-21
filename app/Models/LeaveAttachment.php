<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveAttachment extends Model
{
    //


	protected $table = 'leave_attachments';


	public function create_file($data) {
		$this->user_id = $data['user_id'];		
		$this->leave_id = $data['leave_id'];		
		$this->filename = $data['filename'];		
		$this->ext = $data['ext'];		
		$this->size = $data['size'];	
		$this->status = $data['status'];	
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}			
	}
	    
}
