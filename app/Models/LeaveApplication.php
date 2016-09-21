<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaveApplication extends Model
{
    //


	protected $table = 'leave_applications';

	public function LeaveUserDetail() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}

	public function LeaveSiteName() {
		return $this->belongsTo('\App\Models\Site', 'sitecode');
	}	

	// belongs to
	public function LeaveTypeName() {
		return $this->belongsTo('\App\Models\LeaveType', 'leave_type_id');
	}

	public function LeaveReportToName() {
		return $this->belongsTo('\App\Models\User', 'report_to');
	}

	// get only latest history
	public function LeaveLatestHistory() {
		return $this->hasOne('\App\Models\LeaveHistory', 'leave_id')->where('flag', 1);
	}

	public function LeavePending() {
		return $this->hasOne('\App\Models\LeaveHistory', 'leave_id')->where('flag', 1)->where('status', 1);
	}

	// hasmany
	public function LeaveAllHistory() {
		return $this->hasMany('\App\Models\LeaveHistory', 'leave_id');
	}

	public function LeaveDateAll() {
		return $this->hasMany('\App\Models\LeaveDate', 'leave_id');
	}
		
	public function LeaveDate() {
		return $this->hasMany('\App\Models\LeaveDate', 'leave_id')->where('status', '=', 1);
	}





	public static $rules = [
		'leave_create' => [
			'leave_type_id' => 'required',
			'desc' => 'required',
			'date_from' => 'required',
			// 'date_to' => 'required',
			'leave_file' => 'min:1|max:5000|mimes:jpeg,jpg,bmp,png,gif,pdf,doc'
		],	
		'leave_edit' => [
			'leave_type_id' => 'required',
			'desc' => 'required',
			'date_from' => 'required',
			'date_to' => 'required',
		],	
	];





    public static $messages = array(
		'leave_type_id.required' => 'Please select Leave Type.',
		'desc.required' => 'Please insert Description.',
		'date_from.required' => 'Please select Start Date',
		'date_to.required' => 'Please select End Date',
		'leave_file.mimes' => 'File type is not allowed.',
		'leave_file.min' => 'File is too small',
		'leave_file.max' => 'File is too large. Max size is 5mb.'
    );





	public function leave_create($data) {
		$msg = array();
		$invalid = 0;
		$status = 0;
		$balance = 0;
		$more = 0;
		$success = 0;
		$email = 0;

		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		// $to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"
		// $x = Carbon::createFromFormat('d/m/Y', $data['date_from'])->addDays(2)->toDateTimeString();




		// check date to
		if (!empty($data['date_to'])) {
			$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d');
		}
		else {
			// get date to automatically
			$to = Carbon::createFromFormat('d/m/Y', $data['date_from'])->addDays(2)->toDateTimeString();
		}

		


		// echo Carbon::createFromFormat('d/m/Y', $data['date_from'])->toDateTimeString(); die();
		echo Carbon::createFromFormat('d/m/Y', $data['date_from'])->toDateTimeString()->addDays(3); die();
		// echo $from->toDateTimeString(); die();


		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true

			// get date range
			$duration = Helper::DateRange($from, $to);	

			// check if selected date is more than entitled leave 
			if (!in_array($data['leave_type_id'], array(1, 6, 12))) { // exclude annual/replacement/unpaid
				$type = LeaveType::where('id', $data['leave_type_id'])->first(); // get total from leave_types
				if (count($duration) > $type->total) {
					$more = 1; // skip insert leave
				}
			}

			if ($more != 1) {
				// check record on leave_balances
				$q = LeaveBalance::where('user_id', Auth::user()->id)
					->where('leave_type_id', $data['leave_type_id'])
					->where('contract_id', 1)
					->first();		
				if ($q) {	
					// no balance leave
					if ($q->balance == 0) {
						$balance = 2; // skip insert leave
					}
					// balance still have value
					else {
						$status = 1;
						$balance = 0;
					}
				}
				// no record on leave_balances
				else {
					$status = 1;
					$balance = 1;
				}
			}

			if ($status == 1 && $more != 1) {
				// insert leave_applications
				$leave_id = DB::table('leave_applications')->max('id') + 1;	
				$this->id = $leave_id;
				$this->user_id = Auth::id();
				$this->leave_type_id = $data['leave_type_id'];
				$this->date_apply = date('Y-m-d');
				$this->report_to = $data['report_to'];
				$this->date_from = $from;
				$this->date_to = $to;			
				if (!empty($data['is_half_day'])) {
					$this->is_half_day = $data['is_half_day'];
				}
				$this->desc = $data['desc'];
				$this->sitecode = Auth::user()->sitecode;
				$this->active = 1; // leave active
				$this->save();

				// check public holiday date
				$s = Helper::getUserStateID(Auth::user()->sitecode);
				$s_p = array();			
				if ($s) {
					$state_id = $s->state_id;

					// get public date of current state and state_id equal 0 (all states)
					$p = LeavePublicState::where('state_id', $state_id)->orWhere('state_id', 0)->get();
					if ($p) {
						foreach ($p as $date) {
							$s_p[] = $date->date;
						}					
					}
				}

				// insert leave_dates
				$d = array();		
				$day = 0;	
				foreach ($duration as $date) {
					if (in_array($date, $s_p)) {
						$status = 0; // selected date is on public holiday (reject)
					}
					else {
						$status = 1;
						$day++;
					}
					$d = array(
						'user_id' => Auth::id(),				
						'leave_id' => $leave_id,
						'leave_date' => $date,
						'status' => $status,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					LeaveDate::insert($d);
				}
				
				// insert leave_histories
				$h = new LeaveHistory();
				$h->user_id = Auth::id();
				$h->leave_id = $leave_id;
				$h->action_date = date('Y-m-d');
				$h->action_remark = '';
				$h->status = 1; // pending
				$h->flag = 1; // active 1st
				$h->save();

				// check if have attachment
				if ($data['leave_file']) {			
					$image = $data['leave_file'];
					$path = public_path().'/assets/files/leave/';
					$filename = date('YmdHis').rand();
					$fileext = $image->getClientOriginalExtension();
					$filesize = $image->getSize();						
					$filenew = $filename.'.'.$fileext;
					$upload = $image->move($path, $filenew);

					// insert leave_attachments
					$a = new LeaveAttachment();
					$a->user_id = Auth::id();
					$a->leave_id = $leave_id;
					$a->filename = $filename;
					$a->ext = $fileext;		
					$a->size = $filesize;
					$a->status = 1;
					$a->save();
				}	
				$success = 1;	
			}

			if ($balance == 1 && $more != 1) {
				// insert leave_balances									
				if ($data['leave_type_id'] == 1) { // annual lave
					
					// get total entitled days from contract date
					$total = Helper::getTotalAL($data['contract_date_from'], $data['contract_date_to']); 					
				}
				else {
					// get total entitled days from leave_types
					$t = LeaveType::where('id', $data['leave_type_id'])->first(); 
					$total = $t->total;
				}

				// get contract id
				$c = UserContract::where('user_id', Auth::user()->id)->where('status', 1)->first();

				$b = new LeaveBalance();
				$b->user_id = Auth::user()->id;
				$b->leave_type_id = $data['leave_type_id'];
				$b->balance = $total;
				$b->contract_id = 0;
				$b->year = date('Y');
				$b->save();
				$success = 1;				
			}
		} 
		else {
			$invalid = 1;
		}
		// end check invalid

		// return message
		if ($invalid == 1) {
			$msg = array('message' => 'Selected Date is invalid.', 'label' => 'danger');
		}
		if ($more == 1) {
			$msg = array('message' => 'Total selected days is more than entitled leave.', 'label' => 'danger');				
		}
		if ($balance == 2) {
			$msg = array('message' => 'Entitled Leave currently empty.', 'label' => 'danger');		
		}
		if ($success == 1) {
			$msg = array('message' => 'Leave successfully added.', 'label' => 'success');			
		}

		// send email notification to regional manager
		if ($email == 1) {
			$rm = Helper::getRegionManager(Auth::user()->sitecode);
			if ($rm) {
				// $name = $rm['region_name']['region_manager']['name'];
				// $email = $rm['region_name']['region_manager']['work_email'];
			}
		}
		return $msg;
	}	



}
