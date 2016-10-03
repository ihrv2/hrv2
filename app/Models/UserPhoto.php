<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    //


	protected $table = 'user_photos';


    protected $fillable = [
    	'user_id',
    	'photo',
    	'photo_thumb',
    	'ext',
    	'size',
    	'status'
    ];

    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


	public function upload_photo($data) {
		// inactive current photo
		$update = \IhrV2\Models\UserPhoto::where('user_id', $data['id'])->where('status', 1)->update(array('status' => 0));
		// insert new record
		$this->user_id = $data['id'];
		$this->photo = $data['photo'];
		$this->photo_thumb = $data['photo_thumb'];
		$this->ext = $data['ext'];
		$this->size = $data['size'];
		$this->status = 1;
		$this->save();					
		$msg = array('Photo successfully added.', 'success', 'mod.user.view');	
		return $msg;		
	}


	public function remove_photo($data) {

	}	


}

