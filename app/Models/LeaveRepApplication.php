<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepApplication extends Model
{
    //

	protected $table = 'leave_rep_applications';




	// get only latest history
	public function LeaveRepLatestHistory() {
		return $this->hasOne('\App\Models\\App\Models\LeaveRepHistory', 'leave_rep_id')->where('flag', 1);
	}

	public function LeaveRepUserDetail() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}





	public function leave_replace_create($data) {
		// leave_rep_applications
		$id = DB::table('leave_rep_applications')->max('id') + 1;		
		$this->id = $id;		
		$this->user_id = Auth::user()->id;
		$this->date_apply = date('Y-m-d');
		$this->no_day = $data['no_day'];		
		$this->month = $data['month'];		
		$this->year = $data['year'];
		$this->report_to = $data['report_to'];		
		$this->instructed_by = $data['instructed_by'];		
		$this->location = $data['location'];		
		$this->reason = $data['reason'];
		$this->notes = $data['notes'];		
		$this->sitecode = Auth::user()->sitecode;		
		$this->save();

		// leave_rep_histories
		$z = new LeaveRepHistory();
		$z->user_id = Auth::user()->id;
		$z->leave_rep_id = $id;
		$z->action_date = date('Y-m-d');
		$z->status = 1; // pending	
		$z->flag = 1;	
		$z->save();

		// upload file
		if ($data['rep_file']) {			
			$image = $data['rep_file'];
			$path = public_path().'/assets/files/replacement-leave/';
			$filename = date('YmdHis').rand();
			$fileext = $image->getClientOriginalExtension();
			$filesize = $image->getSize();			
			$filenew = $filename.'.'.$fileext;
			$upload = $image->move($path, $filenew);

			// insert leave_attachments
			$j = new LeaveRepAttachment();
			$data = array(
				'user_id' => Auth::user()->id,
				'leave_rep_id' => $id,
				'filename' => $filename,
				'ext' => $fileext,
				'size' => $filesize
			);
			$j->create_file($data);
		}


		return true;		
	}	





	public function leave_replace_update($data) {
		$this->no_days = $data['no_days'];		
		$this->month = $data['month'];		
		$this->year = $data['year'];		
		$this->instructed_by = $data['instructed_by'];		
		$this->site_location = $data['site_location'];		
		$this->reason = $data['reason'];
		$this->notes = $data['notes'];		
		if ($this->save()) {
			return true;
		}
		else {
			return false;
		}	
	}
	    
}
