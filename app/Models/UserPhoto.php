<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    //


	protected $table = 'user_photos';




	public function upload_photo($data) {
		// inactive current photo
		$update = UserPhoto::where('user_id', $data['id'])->where('status', 1)->update(array('status' => 0));
		// insert new record
		$this->user_id = $data['id'];
		$this->photo = $data['photo'];
		$this->photo_thumb = $data['photo_thumb'];
		$this->ext = $data['ext'];
		$this->size = $data['size'];
		$this->status = 1;
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}		
	}


	public function remove_photo($data) {

	}	


}

