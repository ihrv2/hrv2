<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRepApplication extends Model
{
    //

	protected $table = 'leave_rep_applications';



    protected $fillable = [
    	'user_id',
    	'date_apply',
    	'no_day',
    	'month',
    	'year',
    	'report_to',
    	'instructed_by',
    	'location',
    	'reason',
    	'notes',
    	'sitecode'
    ];



	// get only latest history
	public function LeaveRepLatestHistory() {
		return $this->hasOne('IhrV2\Models\LeaveRepHistory', 'leave_rep_id')->where('flag', 1);
	}

	public function LeaveRepUserDetail() {
		return $this->belongsTo('IhrV2\User', 'user_id');
	}




	public function leave_rep_create($data) {
		$user_id = \Auth::user()->id;

		// insert leave_rep_applications
		$this->user_id = $user_id;
		$this->date_apply = date('Y-m-d');
		$this->no_day = $data['no_day'];		
		$this->month = $data['month'];		
		$this->year = $data['year'];
		$this->report_to = $data['report_to'];		
		$this->instructed_by = $data['instructed_by'];		
		$this->location = $data['location'];		
		$this->reason = $data['reason'];
		$this->notes = $data['notes'];		
		$this->sitecode = \Auth::user()->sitecode;		
		$this->save();
		$leave_rep_id = $this->id;

		// insert leave_rep_histories
        $history = array(
            'user_id' => $user_id,
            'leave_rep_id' => $leave_rep_id,
            'action_date' => date('Y-m-d'),
            'action_remark' => '',
            'next_action_by' => '',
            'status' => 1, // pending
            'flag' => 1 // active
        );
        $h = new \IhrV2\Models\LeaveRepHistory($history);
        $h->save();

		// check if have attachment
		if (!empty($data['rep_file'])) {		
			$file = $data['rep_file'];
			$path = public_path().'/assets/files/replacement-leave/';
			$filename = date('YmdHis').'_'.\Auth::user()->sitecode.'_'.str_random(20);
			$fileext = $file->getClientOriginalExtension();
			$filesize = $file->getSize();						
			$filenew = $filename.'.'.$fileext;
			$upload = $file->move($path, $filenew);

			// insert leave_attachments
			$attachment = array(
				'user_id' => $user_id,
				'leave_rep_id' => $leave_rep_id,
				'filename' => $filename,
				'ext' => $fileext,
				'size' => $filesize,
				'status' => 1
			);
			$t = new \IhrV2\Models\LeaveRepAttachment($attachment);
			$t->save();
		}

		$msg = array('Replacement Leave successfully added.', 'success', 'sv.leave.replacement.index');
		return $msg;		
	}	





	public function leave_rep_update($data) {

	}
	    
}
